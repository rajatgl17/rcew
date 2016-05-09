package com.project.schoolmessenger.helpers;

/**
 * Created by Admin on 06-Apr-16.
 */

public class Constants {
    private static Constants mInstance= null;

    protected Constants(){}

    public static synchronized Constants getInstance(){
        if(null == mInstance){
            mInstance = new Constants();
        }
        return mInstance;
    }

    public String base_url="http://rajatgoel.in/school_messenger/";
}

//Constants.getInstance().base_url