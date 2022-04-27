function Filter()

{
    var code;
    var character;
    var err_msg = "Text can not contain SPACES or any of these special characters other than underscore (_) and hyphen.";
    if (document.all) //IE or Not
    {
        code = window.event.keyCode;
    }
    else
    {
        code = arguments.callee.caller.arguments[0].which;
    }
    var character = String.fromCharCode(code);
    
    var txt=new RegExp("[ ,\\`,\\~,\\!,\\@,\#,\\$,\\%,\\^,\\+,\\*,\\&,\\\\,\\/,\\?,\\|,\\:,\\.,\\<,\\>,\\{,\\},\\(,\\),\\',\\;,\\=,\"]");
    //Improper Characters
    if (txt.test(character))
    {
        alert("Improper Character Detected !"); //:\n , ` ~ ! @ # $ % ^ + & * \\ / ? | : . < > {} () [] \" 
        if (document.all)
        {
            window.event.returnValue = false;
        }
        else
        {
            arguments.callee.caller.arguments[0].preventDefault();
        }
    }
}