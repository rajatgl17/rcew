package com.project.schoolmessenger.helpers;

import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;

/**
 * Created by Admin on 08-Apr-16.
 */
public class VolleySingleton {

    private static VolleySingleton sInstance=null;
    private RequestQueue rq;

    private VolleySingleton(){
        rq = Volley.newRequestQueue(MyApplication.getAppContext());
    }

    public static VolleySingleton getsInstance(){
        if(sInstance==null)
            sInstance = new VolleySingleton();
        return  sInstance;
    }

    public RequestQueue getReqQu(){
        return rq;
    }
}
