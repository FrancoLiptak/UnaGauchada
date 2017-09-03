function validateFormLogIn() {
	var email = document.logIn_form.email.value;
    if (email == null || email.length == 0 || /^\s*$/.test(email)){
        alert("El campo 'Email' no puede estar vacio o contener sólo espacios en blanco");
        return false;
    }
    var pass = document.logIn_form.pass.value;
    if (pass == null || pass.length == 0 || /^\s*$/.test(pass)){
        alert("El campo 'Password' no puede estar vacio o contener sólo espacios en blanco");
        return false;
    }
    return true;
}
// \s == espacio en blanco
// * == coincide con el elemento anterior 0 ó + veces

/*  • A regular expression is an object that describes a pattern of characters.
    Regular expressions are used to perform pattern-matching and "search-and-replace" functions on text.
   
    • Syntax:
    /pattern/modifiers;

    • Modifiers are used to perform case-insensitive and global searches:
         Modifier    Description
            i   Perform case-insensitive matching
            g   Perform a global match (find all matches rather than stopping after the first match)
            m   Perform multiline matching
        
    •Brackets are used to find a range of characters:
        Expression  Description
        [abc]   Find any character between the brackets
        [^abc]  Find any character NOT between the brackets
        [0-9]   Find any digit between the brackets
        [^0-9]  Find any digit NOT between the brackets
        (x|y)   Find any of the alternatives specified

    • Metacharacters are characters with a special meaning:
        \s  Find a whitespace character
        \S  Find a non-whitespace character
        \d  Find a digit
        \D  Find a non-digit character

    • Quantifier    Description
            n+      Matches any string that contains at least one n
            n*      Matches any string that contains zero or more occurrences of n
            n?      Matches any string that contains zero or one occurrences of n
            n{X}    Matches any string that contains a sequence of X n's
            n{X,Y}  Matches any string that contains a sequence of X to Y n's
            n{X,}   Matches any string that contains a sequence of at least X n's
            n$      Matches any string with n at the end of it
            ^n      Matches any string with n at the beginning of it
            ?=n     Matches any string that is followed by a specific string n
            ?!n     Matches any string that is not followed by a specific string n

    • RegExp Object Methods
        compile()   Deprecated in version 1.5. Compiles a regular expression
        exec()  Tests for a match in a string. Returns the first match
      * test()  Tests for a match in a string. Returns true or false *
        toString()  Returns the string value of the regular expression
*/