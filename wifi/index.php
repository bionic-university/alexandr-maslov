<?php
include_once("templates/headerTemplate.php");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <?php
            include_once("templates/indexTemplate.php");
            ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <button class="btn btn-primary deleteButton">Delete</button>
    </div>
</div>
</div>
</body>
<script type="text/javascript">
    $('.groupChildCheckbox').change(function () {
        var tmp = $(this).attr('class');
        var childClassName = tmp.substr(19, tmp.length - 32);
        var childAmount = $('.' + childClassName + 'CheckboxChild').length;
        console.log(childAmount);
        var checkedChildAmount = $('.' + childClassName + 'CheckboxChild:checked').length;
        if (childAmount != checkedChildAmount) {
            $('.' + childClassName + 'Checkbox').prop('checked', false);
        }
        if (childAmount == checkedChildAmount) {
            $('.' + childClassName + 'Checkbox').prop('checked', true);
        }
    })
    $('.groupCheckbox').change(function () {
        var tmp = $(this).attr('class');
        var childClassName = tmp.substr(14, tmp.length - 22);
        var childAmount = $('.' + childClassName + 'CheckboxChild').length;
        var checkedChildAmount = $('.' + childClassName + 'CheckboxChild:checked').length;
        if (this.checked) {
            if (childAmount != checkedChildAmount) {
                $('.' + childClassName + 'CheckboxChild').prop('checked', true);
            }
        }
        if (!this.checked) {
            if (childAmount == checkedChildAmount) {
                $('.' + childClassName + 'CheckboxChild').prop('checked', false);
            }
        }
    });
    $('.deleteButton').click(function () {
        var checkedIdList = [];
        $('.groupChildCheckbox:checked').each(function () {
            checkedIdList.push($(this).attr('value'));
        });
        if (confirm('Are you sure you want to delete ' + checkedIdList.length + ' students ?')) {
            $.ajax({
                url: "delete.php",
                type: "POST",
                data: {checkedIdList: checkedIdList}
            })
                .done(function (response) {
                    $('.groupChildCheckbox:checked').each(function () {
                        $('#' + $(this).attr('value')).remove();
                    })
                })
                .fail(function (response) {
                })
                .always(function (response) {
                })
        }
    });
    $('tr').mouseenter(function () {
        $(this).addClass('active');
    });
    $('tr').mouseleave(function () {
        $(this).removeClass('active');
    })
</script>
</html>