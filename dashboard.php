<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="dashboard-header">
        <!-- the dashboard header -->
        <div class="logo">
            <h2><img src="logo.png" width="50" height="50"></h2>
        </div>
        <div class="buttons">
            <button class="btn1"> Dashboard </button>
            <!-- Dashboard button -->
            <button class="btn2"> Logout </button>
            <!-- Logout button -->
            <button class="btn3" onclick="openVirtualKeyboard()"> Virtual Keyboard </button>
        </div>
    </div>

    <!-- Welcoming person to the dashboard -->
    <h1> Hello <span><?php echo "Welcome to the Dashboard" ?></span></h1><br>

    <div class="content">

        <a class="flex1" href="accountPage.php">
            <!-- Account Page button -->
            Account Page
        </a>

        <a class="flex2" href="supportGroup.php">
            <!-- Support Group button -->
            Support Groups
        </a>

        <a class="flex3" href="survey.php">
            <!-- Survey button -->
            Surveys
        </a>

        <a class="flex4" href="studies.php">
            <!-- Studies button -->
            Studies
        </a>

        <a class="flex5" href="opportunities.php">
            <!-- Opportunities button -->
            Opportunities
        </a>

        <a class="flex5" href="">
            <!-- Opportunities button -->
            Opportunities
        </a>

    </div>

    <script>
        function openVirtualKeyboard() {
            // Create a new window for the virtual keyboard
            var virtualKeyboardWindow = window.open("", "Virtual Keyboard", "width=400,height=400");
            virtualKeyboardWindow.document.write(`
                <div class="textContainer">
                </div>
                <div class="keyboard">
                    <div class="row">
                        <div class="key">1</div>
                        <div class="key">2</div>
                        <div class="key">3</div>
                        <div class="key">4</div>
                        <div class="key">5</div>
                        <div class="key">6</div>
                        <div class="key">7</div>
                        <div class="key">8</div>
                        <div class="key">9</div>
                        <div class="key">0</div>   
                        <div class="key delete"><i class="fa-solid fa-delete-left"></i></div>
                    </div>
                        </div>
                            <div class="row">
                            <div class="key">q</div>
                            <div class="key">w</div>
                            <div class="key">e</div>
                            <div class="key">r</div>
                            <div class="key">t</div>
                            <div class="key">y</div>
                            <div class="key">u</div>
                            <div class="key">i</div>
                            <div class="key">o</div>
                            <div class="key">p</div>
                    </div>
                    <div class="row">
                        <div class="key capslock">CapsLock</div>
                        <div class="key">a</div>
                        <div class="key">s</div>
                        <div class="key">d</div>
                        <div class="key">f</div>
                        <div class="key">g</div>
                        <div class="key">h</div>
                        <div class="key">j</div>
                        <div class="key">k</div>
                        <div class="key">l</div>
                        <div class="key enter">Enter</div>
                    </div>
                    <div class="row last">
                        <div class="key">z</div>
                        <div class="key">x</div>
                        <div class="key">c</div>
                        <div class="key">v</div>
                        <div class="key">b</div>
                        <div class="key">n</div>
                        <div class="key">m</div>
                    </div>
                    <div class="row">
                        <div class="key space"></div>
                    </div>
                </div>
                </div>
            `);
        }
    </script>

</body>

</html>