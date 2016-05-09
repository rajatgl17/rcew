package com.project.schoolmessenger;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.support.v4.content.SharedPreferencesCompat;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.project.schoolmessenger.helpers.Constants;
import com.project.schoolmessenger.helpers.VolleySingleton;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by Admin on 08-Apr-16.
 */
public class SplashActivity extends AppCompatActivity {

    public static final String DEFAULT = "nullvalue";
    ProgressBar pb;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.splashactivity);

        pb = (ProgressBar) findViewById(R.id.progressBar);

        SharedPreferences sp = getSharedPreferences("info", Context.MODE_PRIVATE);

        if (sp.getString("rollno", DEFAULT).equals(DEFAULT)) {
            Intent i = new Intent(getBaseContext(), LoginActivity.class);
            startActivity(i);

        } else {

            Thread timer = new Thread(){
                public void run(){
                    try {
                        Thread.sleep(3000);

                        if(!isNetworkAvailable()){
                            pb.setAlpha(0);
                            Toast.makeText(getBaseContext(), "No internet connection available.", Toast.LENGTH_LONG).show();

                        } else {
                            Intent i = new Intent(getBaseContext(), NoticeActivity.class);
                            startActivity(i);
                        }

                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                }
            };
            timer.start();


            /*if(!isNetworkAvailable()){
                pb.setAlpha(0);
                Toast.makeText(getBaseContext(), "No internet connection available.", Toast.LENGTH_LONG).show();

            } else {
                Intent i = new Intent(getBaseContext(), NoticeActivity.class);
                startActivity(i);
            }*/


        }

    }

    @Override
    protected void onPause() {
        super.onPause();
        finish();
    }

    private boolean isNetworkAvailable() {
        ConnectivityManager connectivityManager
                = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();
        return activeNetworkInfo != null && activeNetworkInfo.isConnected();
    }
}

