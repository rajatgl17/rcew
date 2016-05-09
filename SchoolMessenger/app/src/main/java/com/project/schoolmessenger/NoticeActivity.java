package com.project.schoolmessenger;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import com.project.schoolmessenger.helpers.Constants;

public class NoticeActivity extends AppCompatActivity {

    WebView webView;
    public static final String DEFAULT = "nullvalue";
    ProgressDialog progressDialog;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.noticeactivity);

        webView=(WebView)findViewById(R.id.webView);

        SharedPreferences sp = getSharedPreferences("info", Context.MODE_PRIVATE);
        String RollNo = sp.getString("rollno", DEFAULT);
        String selected_branch = sp.getString("branch", DEFAULT);
        String selected_year = sp.getString("year", DEFAULT);

        String url = Constants.getInstance().base_url + "api/noticelist.php?rollno=" + RollNo + "&branch=" + selected_branch+ "&year=" + selected_year;
        startWebView(url);
        if (progressDialog == null) {
            progressDialog = new ProgressDialog(NoticeActivity.this);
            progressDialog.setMessage("Loading...");
            progressDialog.show();
        }

    }

    private void startWebView(String url) {

        webView.setWebViewClient(new WebViewClient() {


            public boolean shouldOverrideUrlLoading(WebView view, String url) {
                view.loadUrl(url);
                return true;
            }

            public void onLoadResource (WebView view, String url) {

            }
            public void onPageFinished(WebView view, String url) {
                try{
                    if (progressDialog.isShowing()) {
                        progressDialog.dismiss();
                        progressDialog = null;
                    }
                }catch(Exception exception){
                    exception.printStackTrace();
                }
            }

            public void onReceivedError(WebView view, int errorCode, String description, String failingUrl) {
                String summary = "<html><body><b>There has been some error. Please retry.</b></body></html>";
                view.loadData(summary, "text/html", null);


            }

        });

        webView.getSettings().setJavaScriptEnabled(true);

        // Other webview options
        /*
        webView.getSettings().setLoadWithOverviewMode(true);
        webView.getSettings().setUseWideViewPort(true);
        webView.setScrollBarStyle(WebView.SCROLLBARS_OUTSIDE_OVERLAY);
        webView.setScrollbarFadingEnabled(false);
        webView.getSettings().setBuiltInZoomControls(true);
        */

        /*
         String summary = "<html><body>You scored <b>192</b> points.</body></html>";
         webview.loadData(summary, "text/html", null);
         */

        //Load url in webview
        webView.loadUrl(url);


    }


    @Override
    public void onBackPressed() {
        if(webView.canGoBack()) {
            webView.goBack();
        } else {
            super.onBackPressed();
        }
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

        } else if (id == R.id.action_contact) {
            Intent i = new Intent(getBaseContext(), FeedbackActivity.class);
            startActivity(i);
            return true;

        } else if (id == R.id.action_logout) { //working
            SharedPreferences sp = getSharedPreferences("info", Context.MODE_PRIVATE);
            SharedPreferences.Editor e = sp.edit();
            e.putString("rollno", SplashActivity.DEFAULT);
            e.commit();
            Intent i = new Intent(getBaseContext(), LoginActivity.class);
            startActivity(i);
            return true;

        } else if (id == R.id.action_profile) { //working
            Intent i = new Intent(getBaseContext(), ProfileActivity.class);
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
