<?php
include_once("templates/headerTemplate.php");
?>
<div class="row">
    <div class="col-xs-2 form-group">
        <label for="inputForGroup">Group: </label>
        <input type="text" class="form-control col-xs-1" id="inputForGroup" placeholder="KM-41-C">
    </div>
    <div class="col-xs-2 form-group">
        <label for="tarifSelector">Tarif</label>
        <select class="form-control" id="tarifSelector">
            <?php
            include_once('templates/tarifsTemplate.php');
            ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-xs-9">
        <table class="table displayNone" id="userTable">
            <thead>
            <tr>
                <th>Full Name</th>
                <th>Login</th>
                <th>Password</th>
                <th>Tarif</th>
            </tr>
            </thead>
            <tbody id="userTableBody">
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-xs-2">
        <label for="inputForStudentLastName">Last Name: </label>
        <input type="text" class="form-control col-xs-1" id="inputForStudentLastName" placeholder="Маслов">
    </div>
    <div class="col-xs-2">
        <label for="inputForStudentFirstName">First Name: </label>
        <input type="text" class="form-control col-xs-1" id="inputForStudentFirstName" placeholder="Олександр">
    </div>
    <div class="col-xs-2">
        <label for="inputForStudentMiddleName">Middle Name: </label>
        <input type="text" class="form-control col-xs-1" id="inputForStudentMiddleName" placeholder="Iгорович">
    </div>
    <div class="col-xs-2">
        <label for="tarifChosen">Chosen Tarif: </label>
        <span class="form-control col-xs-1" disabled id="tarifChosen"></span>
    </div>
    <div class="col-xs-2">
        <label for="generateButton">Press to preview data</label>
        <button class="form-control" id="generateButton">Generate</button>
    </div>
</div>
<hr>
<form role="form" enctype="multipart/form-data" method="post" action="src/UserGenerator.php" id="uploadForm">
    <div class="form-group">
        <label for="inputFile">File input</label>
        <input type="file" id="inputFile" accept=".txt" name="userFile">

        <p class="help-block">Choose student list file (.txt)</p>
    </div>
    <button class="btn btn-default" id="uploadButton">Upload</button>
    <button class="btn btn-primary" id="addUser">Add users</button>
</form>

</div>
</body>
<script type="text/javascript">
    var i = 0;
    var selectedOption = $('#tarifSelector')[0].value;
    $('#tarifChosen').text($('#tarifSelector')[0].value);
    $('#tarifSelector').change(function () {
        $('#tarifChosen').text(this.value);
        selectedOption = this.value;
    });
    $('#uploadButton').click(function (e) {
        e.preventDefault();
        var fileData = $('#inputFile').prop('files')[0];
        var usersFile = new FormData();
        usersFile.append('file', fileData);
        var users = [];
        $.ajax({
            url: "src/UserGenerator.php",
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            data: usersFile,
            async: true
        })
            .done(function (response) {
                while (response.slice(-1) != ']') {
                    response = response.slice(0, -1);
                }
                if (response == 'bad]') {
                    alert('validation error');
                }
                else {
                    users = $.parseJSON(response);
                    $('#userTable').removeClass('displayNone');
                    for (var iterator = 0; iterator < users.length; iterator++) {
                        $('#userTableBody').append('' +
                        '<tr>' +
                        '<td>' + users[iterator]['fullName'] + '</td>' +
                        '<td><input type="text" id="username_' + i + '"value="' + users[iterator]['userName'] + '"></td>' +
                        '<td><input type="text" id="password_' + i + '"value="' + users[iterator]['password'] + '"></td>' +
                        '<td id="tarif_' + i + '"></td>' +
                        '</tr>');
                        $('select#tarifSelector').clone().attr('id', 'newOptions_' + i).appendTo('#tarif_' + i);
                        $('#newOptions_' + i)[0].value = selectedOption;
                        i++;
                    }
                }
            })
            .fail(function (response) {
            })
            .always(function (response) {
            });
        $("#inputFile").val(null);
    });
    $('#generateButton').click(function () {
        var studentFullName = $('#inputForStudentLastName')[0].value + ' ' + $('#inputForStudentFirstName')[0].value + ' ' + $('#inputForStudentMiddleName')[0].value;
        $.ajax({
            url: "src/UserGenerator.php",
            type: 'POST',
            data: {studentFullName: studentFullName},
            async: true
        })
            .done(function (response) {
                while (response.slice(-1) != ']') {
                    response = response.slice(0, -1);
                }
                if (response == 'bad]') {
                    alert('validation error');
                }
                else {
                    users = $.parseJSON(response);
                    $('#userTable').removeClass('displayNone');
                    for (var iterator = 0; iterator < users.length; iterator++) {
                        $('#userTableBody').append('' +
                        '<tr>' +
                        '<td>' + users[iterator]['fullName'] + '</td>' +
                        '<td><input type="text" id="username_' + i + '"value="' + users[iterator]['userName'] + '"></td>' +
                        '<td><input type="text" id="password_' + i + '"value="' + users[iterator]['password'] + '"></td>' +
                        '<td id="tarif_' + i + '"></td>' +
                        '</tr>');
                        $('select#tarifSelector').clone().attr('id', 'newOptions_' + i).appendTo('#tarif_' + i);
                        $('#newOptions_' + i)[0].value = selectedOption;
                        i++;
                    }
                }
            })
            .fail(function (response) {
            })
            .always(function (response) {
            });
    })
    $('#addUser').click(function (e) {
        e.preventDefault();
        var students = [];
        var jsonString;
        for (var iterator = 0; iterator < i; iterator++) {
            students[iterator] = [];
            var group = $('#inputForGroup')[0].value;
            var username = $('#username_' + iterator)[0].value;
            var name = $('#username_' + iterator).parent().prev().text();
            var password = $('#password_' + iterator)[0].value;
            var tarif = $('#newOptions_' + iterator)[0].value;
            students[iterator].push(group, username, name, password, tarif);
            jsonString = JSON.stringify(students);
        }
        $.ajax({
            url: "create.php",
            type: 'POST',
            data: {jsonString: jsonString},
            async: true
        })
            .done(function (response) {
            })
            .fail(function (response) {
            })
            .always(function (response) {
            });
    })

</script>
</html>