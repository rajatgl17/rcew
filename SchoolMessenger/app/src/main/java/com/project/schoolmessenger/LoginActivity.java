package com.project.schoolmessenger;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.net.Uri;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.telecom.Call;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonObjectRequest;
import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GooglePlayServicesUtil;
import com.project.schoolmessenger.helpers.Constants;
import com.project.schoolmessenger.helpers.VolleySingleton;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by Admin on 06-Apr-16.
 */
public class LoginActivity extends AppCompatActivity implements AdapterView.OnItemSelectedListener {

    Button login;
    ProgressBar pb;
    EditText rollno, password;
    String RollNo, Password;
    int selected_branch, selected_year;
    Spinner branch_select, year_select;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.loginactivity);

        branch_select = (Spinner) findViewById(R.id.select_branch);
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this,
                R.array.branches, android.R.layout.simple_spinner_item);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        branch_select.setAdapter(adapter);
        branch_select.setOnItemSelectedListener(this);

        year_select = (Spinner) findViewById(R.id.select_year);
        ArrayAdapter<CharSequence> adapter2 = ArrayAdapter.createFromResource(this,
                R.array.years, android.R.layout.simple_spinner_item);
        adapter2.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        year_select.setAdapter(adapter2);
        year_select.setOnItemSelectedListener(this);

        login = (Button) findViewById(R.id.login);
        pb = (ProgressBar) findViewById(R.id.pb);
        pb.setAlpha(0);

        rollno = (EditText) findViewById(R.id.rollno);
        password = (EditText) findViewById(R.id.password);

        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                RollNo = rollno.getText().toString();
                Password = password.getText().toString();

                if (!isNetworkAvailable()) {
                    Toast.makeText(getBaseContext(), "No internet connection available.", Toast.LENGTH_LONG).show();
                } else if (RollNo.isEmpty() || Password.isEmpty())
                    Toast.makeText(getBaseContext(), "All fields are mandatory.", Toast.LENGTH_LONG).show();
                else {
                    pb.setAlpha(1);

                    String url = Constants.getInstance().base_url + "api/login.php?rollno=" + RollNo + "&branch=" + selected_branch+ "&year=" + selected_year + "&password=" + Password;
                    Log.e("ad", url);

                    JsonObjectRequest jsonObjReq = new JsonObjectRequest(Request.Method.GET,
                            url, null,
                            new Response.Listener<JSONObject>() {

                                @Override
                                public void onResponse(JSONObject response) {
                                    try {
                                        if (response.getInt("status") == 1) {
                                            JSONArray ja = response.getJSONArray("data");
                                            JSONObject jo = ja.getJSONObject(0);

                                            SharedPreferences sp1 = getSharedPreferences("info", Context.MODE_PRIVATE);
                                            SharedPreferences.Editor e1 = sp1.edit();
                                            e1.putString("rollno", jo.getString("rollno"));
                                            e1.putString("sn", jo.getString("name"));
                                            e1.putString("gn", jo.getString("parentname"));
                                            e1.putString("branch", jo.getString("branch"));
                                            e1.putString("year", jo.getString("year"));
                                            e1.commit();

                                            //


                                            //
                                            Intent i = new Intent(getBaseContext(), NoticeActivity.class);
                                            startActivity(i);

                                        } else {
                                            Toast.makeText(getBaseContext(), "Invalid login details.", Toast.LENGTH_LONG).show();
                                        }
                                    } catch (JSONException e) {
                                        Toast.makeText(getBaseContext(), "There has been some error.Please retry.", Toast.LENGTH_LONG).show();
                                    }
                                    pb.setAlpha(0);
                                }
                            }, new Response.ErrorListener() {

                        @Override
                        public void onErrorResponse(VolleyError error) {
                            pb.setAlpha(0);
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
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
        switch(parent.getId()){
            case R.id.select_branch: selected_branch = position + 1; break;
            case R.id.select_year: selected_year = position + 1; break;
        }
    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }

    private boolean isNetworkAvailable() {
        ConnectivityManager connectivityManager
                = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();
        return activeNetworkInfo != null && activeNetworkInfo.isConnected();
    }


}


