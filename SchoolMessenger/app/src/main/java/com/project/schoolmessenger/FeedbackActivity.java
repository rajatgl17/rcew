package com.project.schoolmessenger;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
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
public class FeedbackActivity extends AppCompatActivity {

    EditText subject,message;
    Button contact;
    ProgressBar pbf;
    public static final String DEFAULT = "nullvalue";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.feedbackactivity);

        contact = (Button) findViewById(R.id.contact);
        subject = (EditText) findViewById(R.id.subject);
        message = (EditText) findViewById(R.id.message);
        pbf = (ProgressBar) findViewById(R.id.progressBarf);
        pbf.setAlpha(0);

        contact.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {

                SharedPreferences sp = getSharedPreferences("info", Context.MODE_PRIVATE);
                String RollNo = sp.getString("rollno", DEFAULT);
                String selected_branch = sp.getString("branch", DEFAULT);
                String selected_year = sp.getString("year", DEFAULT);

                String sub = subject.getText().toString();
                String msg = message.getText().toString();
                Log.e("one",sub);
                msg = msg.replace(" ", "%20");
                sub = sub.replace(" ","%20");
                Log.e("two",sub);

                if(!isNetworkAvailable()){
                    Toast.makeText(getBaseContext(), "No internet connection available.", Toast.LENGTH_LONG).show();
                }
                else if (sub.isEmpty() || msg.isEmpty())
                    Toast.makeText(getBaseContext(), "All fields are mandatory.", Toast.LENGTH_LONG).show();
                else {
                    pbf.setAlpha(1);

                    String url = Constants.getInstance().base_url + "api/contact.php?rollno=" + RollNo + "&branch=" + selected_branch+ "&year=" + selected_year + "&subject=" + sub+ "&message=" + msg;
                    Log.e("ad", url);
                    Toast.makeText(getBaseContext(), url, Toast.LENGTH_LONG).show();

                    JsonObjectRequest jsonObjReq = new JsonObjectRequest(Request.Method.GET,
                            url, null,
                            new Response.Listener<JSONObject>() {

                                @Override
                                public void onResponse(JSONObject response) {
                                    try {
                                        if (response.getInt("status") == 1) {
                                            Toast.makeText(getBaseContext(), "Message sent successfully.", Toast.LENGTH_LONG).show();
                                            subject.setText("");
                                            message.setText("");
                                        } else {
                                            Toast.makeText(getBaseContext(), "There has been some error.Please retry.", Toast.LENGTH_LONG).show();
                                        }
                                    } catch (JSONException e) {
                                        Toast.makeText(getBaseContext(), "There has been some error.Please retry.", Toast.LENGTH_LONG).show();
                                    }
                                    pbf.setAlpha(0);
                                }
                            }, new Response.ErrorListener() {

                        @Override
                        public void onErrorResponse(VolleyError error) {
                            pbf.setAlpha(0);
                            Toast.makeText(getBaseContext(), "There has been some error.Please retry.", Toast.LENGTH_LONG).show();
                        }
                    });

                    RequestQueue rq = VolleySingleton.getsInstance().getReqQu();
                    rq.add(jsonObjReq);

                }
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();

        if (id == R.id.action_home) {
            Intent i = new Intent(getBaseContext(), NoticeActivity.class);
            startActivity(i);
            return true;

        }else if(id == R.id.action_contact){
            Intent i = new Intent(getBaseContext(),FeedbackActivity.class);
            startActivity(i);
            return true;

        }else if(id == R.id.action_logout){
            SharedPreferences sp1 = getPreferences(Context.MODE_PRIVATE);
            SharedPreferences.Editor e = sp1.edit();
            e.putString("rollno",SplashActivity.DEFAULT);
            e.commit();
            Intent i = new Intent(getBaseContext(),LoginActivity.class);
            startActivity(i);
            return true;

        }else  if(id == R.id.action_profile){
            Intent i = new Intent(getBaseContext(),ProfileActivity.class);
            startActivity(i);
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    private boolean isNetworkAvailable() {
        ConnectivityManager connectivityManager
                = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();
        return activeNetworkInfo != null && activeNetworkInfo.isConnected();
    }
}
