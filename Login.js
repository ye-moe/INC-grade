class Login
{
    login(userid,password)
    {
        let dbpass=getCookie(userid);
        if(dbpass==null) return false; //USER DOES EXIST IN DB
        else{  //USER IS IN DATABASE
            if(dbpass==password) //IF PASSWORD MATCH
            {
                setCookie("flag","true");//SESSION VALIDATION
                setCookie("whoami",userid);//CURRENT USER NAME
                return true;    //PASSWORD MATCHES
            }
            else return false;  //PASSWORD DOES NOT MATCH
        }
    }
    logoff()
    {
        setCookie("flag","",-1);
        setCookie("whoami","",-1);
    }
    register(userid,password)
    {
        if(getCookie(userid)==null) //IS USERID in DB
        {   //No in DB
            setCookie(userid,password);
            return true;
        }
        else return false;//ALREADY IN DB
    }
}