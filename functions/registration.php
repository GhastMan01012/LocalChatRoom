<?php
function defaultify($userName) {
    $link = mysqli_connect("127.0.0.1", "root", "root", "UserSettings");
    $sql = "INSERT INTO Colours (UserName, MainBubble, MainBubbleFont, SecondaryBubble, SecondaryBubbleFont, BackgroundColour, AccentColour, HeaderColour, GeneralColour) VALUES ('".$userName."', '#d51c46', '#ffffff', '#dfdfdf', '#116280', '#dfdfdf', '#d51c46', '#116280', '#0696cc')";
    if(!mysqli_query($link, $sql)) {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    // Close connection
    mysqli_close($link);
}
?>