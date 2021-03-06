<?php


Class UserGenerator
{
    private $uploadFilePath;
    private $fullNames;

    public function __construct()
    {
        $uploadDirectory = '/tmp/';
        $this->uploadFilePath = $uploadDirectory . basename($_FILES['file']['name']);

        if (isset($_POST['studentFullName'])) {
        } else {
            try {
                move_uploaded_file($_FILES['file']['tmp_name'], $this->uploadFilePath);
            } catch (Exception $e) {
                echo "Error";
            }
        }
    }

    public function getFileContent()
    {
        if (isset($_POST['studentFullName'])) {
            return $_POST['studentFullName'];
        } else {
            $content = file_get_contents($this->uploadFilePath);
            return $content;
        }
    }

    public function getFullNames()
    {
        if ($this->fullNames == null) {
            $string = $this->getFileContent();
            $rows = explode(PHP_EOL, $string);
            if (sizeof($rows) > 1) {
                array_splice($rows, sizeof($rows) - 1);
            }
            foreach ($rows as $key => $value) {
                $rows[$key] = preg_replace('/\s+/', ' ', $value);
            }
            $this->fullNames = $rows;
        }
        return $this->fullNames;
    }

    public function getUserNames()
    {
        $rows = $this->getFullNames();
        foreach ($rows as $key => $value) {
            $value = $this->transliteration($value);
            $value = strtolower($value);
            $value = preg_replace('~[^-a-z]+~u', '.', $value);
            $value = trim($value, ".");
            $arr = explode('.', $value);
            $rows[$key] = $arr[0] . '.' . $arr[1][0] . '.' . $arr[2][0] . '.';
        }
        return $rows;
    }

    private function transliteration($string)
    {
        $converter = array(
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'ґ' => 'h',
            'д' => 'd',
            'е' => 'e',
            'є' => 'ie',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'y',
            'і' => 'i',
            'ї' => 'i',
            'й' => 'y',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'kh',
            'ц' => 'ts',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'shch',
            'ь' => '',
            'ю' => 'yu',
            'я' => 'ya',
            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Ґ' => 'H',
            'Д' => 'D',
            'Е' => 'E',
            'Є' => 'IE',
            'Ж' => 'ZH',
            'З' => 'Z',
            'И' => 'Y',
            'І' => 'I',
            'Ї' => 'I',
            'Й' => 'Y',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'KH',
            'Ц' => 'TS',
            'Ч' => 'CH',
            'Ш' => 'SH',
            'Щ' => 'SHCH',
            'Ь' => '',
            'Ю' => 'YU',
            'Я' => 'YA',
        );
        return strtr($string, $converter);
    }

    private function getPasswords()
    {
        $passwords = $this->getFullNames();
        foreach ($passwords as $key => $value) {
            $value = $this->transliteration($value);
            $separate = explode(' ', $value);
            $passwords[$key] = strtolower($separate[0][0] . $separate[1][0] . $separate[2][0]) . rand(0, 9) . rand(0,
                    9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
        }
        return $passwords;
    }

    public function validate($string)
    {
        $converter = array(
            '’' => '’’',
            ' ' => '  ',
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'ґ' => 'h',
            'д' => 'd',
            'е' => 'e',
            'є' => 'ie',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'y',
            'і' => 'i',
            'ї' => 'i',
            'й' => 'y',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'kh',
            'ц' => 'ts',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'shch',
            'ь' => '',
            'ю' => 'yu',
            'я' => 'ya',
            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Ґ' => 'H',
            'Д' => 'D',
            'Е' => 'E',
            'Є' => 'IE',
            'Ж' => 'ZH',
            'З' => 'Z',
            'И' => 'Y',
            'І' => 'I',
            'Ї' => 'I',
            'Й' => 'Y',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'KH',
            'Ц' => 'TS',
            'Ч' => 'CH',
            'Ш' => 'SH',
            'Щ' => 'SHCH',
            'Ь' => '',
            'Ю' => 'YU',
        );
        for ($i = 0; $i < strlen($string); $i += 2) {
            $k = 0;
            if ($string[$i] == ' ') {
                $k++;
            }
            if ($string[$i] . $string[$i + 1] . $string[$i + 2] == '’') {
                $k += 3;
            }
            $i += $k;
            $char = $string[$i] . $string[$i + 1];
            if (!(array_key_exists($char, $converter))) {
                return false;
            }
        }
        return true;
    }

    public function generateUsers()
    {
        $fullNames = $this->getFullNames();
        for ($i = 0; $i < sizeof($fullNames); $i++) {
            if (!($this->validate($fullNames[$i]))) {
                return 'bad]';
            }
        }
        $userNames = $this->getUserNames();
        $passwords = $this->getPasswords();
        $users = [];
        foreach ($fullNames as $key => $fullName) {
            $userName = $userNames[$key];
            $password = $passwords[$key];
            $users[$key]['fullName'] = $fullName;
            $users[$key]['userName'] = $userName;
            $users[$key]['password'] = $password;
        }
        $users = json_encode($users);
        return $users;
    }
}

$user = new UserGenerator();
echo $user->generateUsers();
?> 