package com.project.schoolmessenger.helpers;

import android.app.Application;
import android.content.Context;

/**
 * Created by Admin on 08-Apr-16.
 */
public class MyApplication extends Application {

    private static MyApplication sInstance;

    @Override
    public void onCreate() {
        super.onCreate();
        sInstance = this;
    }

    public static MyApplication getInstance(){
        return sInstance;
    }

    public static Context getAppContext(){
        return sInstance.getApplicationContext();
    }
}
