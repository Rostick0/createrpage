<?

function replaceSpaceDash($string) {
    $result = "";

    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] == ' ') {
            $result .= '-';
        } else {
            $result .= $string[$i];
        }
    }

    return $result;
}

function removeComma($string) {
    return str_replace(',' , '', $string);
}

function deleteStringAfterComma($string) {
    $result = "";

    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] == ',') {
            break;
        }

        $result .= $string[$i];
    }

    return $result;
}

function websiteAndEmail($website, $email) {
    $result = '';

    if ($website) {
        $result = "Website";
    }

    if ($website && $email) {
        $result .= " / ";
    }

    if ($email) {
        $result .= "Email";
    }

    return $result;
}

function replaceCommaDiv($elem) {
    $result = "";

    $array = explode(',', $elem);

    foreach ($array as $value) {
        $result .= '<div>' . trim($value) . '</div>';
    }

    return $result;
}

function protectedData($data) {
    return htmlspecialchars(trim(addslashes($data)));
}

?>