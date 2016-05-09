package com.project.schoolmessenger;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.TextView;

/**
 * Created by Admin on 09-Apr-16.
 */
public class ProfileActivity extends AppCompatActivity {

    TextView sn,gn,yr,br,rn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.profileactivity);

        sn=(TextView)findViewById(R.id.sn);
        gn=(TextView)findViewById(R.id.gn);
        br=(TextView)findViewById(R.id.br);
        yr=(TextView)findViewById(R.id.yr);
        rn=(TextView)findViewById(R.id.rn);

        SharedPreferences sp = getSharedPreferences("info", Context.MODE_PRIVATE);
        String branch="Computer Science";
        String year="I year";
        switch(sp.getString("branch",SplashActivity.DEFAULT)){
            case "1": branch = "Computer Science"; break;
            case "2": branch = "Information Technology"; break;
            case "3": branch = "Electronics and Communication"; break;
            case "4": branch="Electrical"; break;
            case "5": branch="Mechanical"; break;
            case "6": branch="Civil"; break;

        }

        switch(sp.getString("year",SplashActivity.DEFAULT)){
            case "1": year = "I year"; break;
            case "2": year = "II year"; break;
            case "3": year = "III year"; break;
            case "4": year = "IV year"; break;
        }

        sn.setText(sp.getString("sn",SplashActivity.DEFAULT));
        gn.setText(sp.getString("gn",SplashActivity.DEFAULT));
        br.setText(branch);
        yr.setText(year);
        rn.setText(sp.getString("rollno",SplashActivity.DEFAULT));
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
            SharedPreferences sp = getPreferences(Context.MODE_PRIVATE);
            SharedPreferences.Editor e = sp.edit();
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
}
