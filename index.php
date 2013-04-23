<html>
<head>
    <script type="text/javascript" src="lib/jquery-2.0.0.min.js"></script>
    <title>JS Minify - by Slavik Meltser</title>
    <script type="text/javascript">
    $(function(){
        $(".add-js").click(function(){
            var li = $("<li />").appendTo("#selected-js")
            var lb = $("<label />").appendTo(li);
            var cb = $("<input />").attr({
                type: "checkbox",
                value: $(this).attr("data-filepath"),
                checked: true,
                name: "files[]"
            }).appendTo(lb);
            lb.append(" "+$(this).attr("data-filename"))
        });
    });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="browser">
            <nav>
                <?
                if ( empty($_GET['path']) ) {
                    $path = dirname(__FILE__);
                } else {
                    $path = $_GET['path'];
                }
                $dh = opendir($path);
                ?>
                <h2><?=$path?></h2>
                <ul>
                    <? while ( $filename = readdir($dh) ) {
                        if ( $filename === "." ) { continue; }
                        $filepath = realpath("$path/$filename");
                        $li = $filename;
                        if ( is_dir($filepath) ) {
                            $li = "<a href=\"?path=$filepath\">$li</a></li>";
                        } else {
                            if ( strtolower(pathinfo($filename, PATHINFO_EXTENSION)) === "js" ) {
                                $li = "<span>$li</span> <a data-filename=\"$filename\" data-filepath=\"$filepath\" class=\"add-js\" href=\"javascript:void(0)\">add</a>";
                            }
                        }
                        ?><li><?=$li?></li><?
                    } ?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="selected-js">
        <form action="api/minify.php" method="post">
            <ol id="selected-js"></ol>
            <label>Filename: <input name="filename" />.js</label>
            <button type="submit">Minify</button>
        </form>
    </div>
</body>
</html>
