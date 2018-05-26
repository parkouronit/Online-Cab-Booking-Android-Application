package com.parkouronitgmail.cabbies;

import android.app.ProgressDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.parkouronitgmail.cabbies.app.AppConfig;
import com.parkouronitgmail.cabbies.app.AppController;
import com.parkouronitgmail.cabbies.helper.SQLiteHandler;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class groupActivity extends AppCompatActivity {
    private Button get,join;
    private TextView daawgcode;
    private EditText code;
    private ProgressDialog pDialog;
    SQLiteHandler dbs;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_group);
        get=(Button)findViewById(R.id.getTag);
        join=(Button)findViewById(R.id.joinTag);
        code=(EditText) findViewById(R.id.enterCode);
//        get.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                HashMap<String, String> user = dbs.getUserDetails();
//                String email = user.get("email");
//                getCode(email);
//            }
//        });
//        join.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                HashMap<String, String> user = dbs.getUserDetails();
//                String email = user.get("email");
//                String dawg=code.getText().toString();
//                joinDawg(email,dawg);
//
//            }
//        });
//        HashMap<String, String> user = dbs.getUserDetails();
//        String email = user.get("email");
//        fetchDawg(email);
    }
}

//    private void getCode(final String email){
//        String tag_string_req = "req_code";
//
//        pDialog.setMessage("Genereation your dawgTag. . .");
//        showDialog();
//        StringRequest strReq = new StringRequest(Request.Method.POST,
//                AppConfig.ROOT_ABOOK, new Response.Listener<String>() {
//
//            @Override
//            public void onResponse(String response) {
//                Log.d("","Response: " + response.toString());
//                hideDialog();
//                try {
//                    JSONObject jObj = new JSONObject(response);
//                    boolean error = jObj.getBoolean("error");
//                    if (!error) {
//                        get.setVisibility(View.GONE);
//                        join.setVisibility(View.GONE);
//                        hideDialog();
//                    }else{
//                        String errorMsg = jObj.getString("error_msg");
//                        Toast.makeText(getApplicationContext(),
//                                errorMsg, Toast.LENGTH_LONG).show();
//                    }
//                }catch (JSONException e) {
//                    // JSON error
//                    e.printStackTrace();
//                    Toast.makeText(getApplicationContext(), "Json error: " + e.getMessage(), Toast.LENGTH_LONG).show();
//                }
//            }
//        }, new Response.ErrorListener() {
//
//            @Override
//            public void onErrorResponse(VolleyError error) {
//                Log.e(" ", "error_msg" + error.getMessage());
//                Toast.makeText(getApplicationContext(),
//                        error.getMessage(), Toast.LENGTH_LONG).show();
//                hideDialog();
//            }
//        }) {
//            @Override
//            protected Map<String, String> getParams() throws AuthFailureError {
//                Map<String, String> params = new HashMap<String, String>();
//                params.put("email", email);
//                return params;
//            }
//        };
//        // Adding request to request queue
//        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
//    }
//    private void joinDawg(final String email,final String dawgTag){
//        String tag_string_req = "req_activebooking";
//
//        pDialog.setMessage("Retrieving your dawgs");
//        showDialog();
//        StringRequest strReq = new StringRequest(Request.Method.POST,
//                AppConfig.ROOT_ABOOK, new Response.Listener<String>() {
//
//            @Override
//            public void onResponse(String response) {
//                Log.d("","Response: " + response.toString());
//                hideDialog();
//                try {
//                    JSONObject jObj = new JSONObject(response);
//                    boolean error = jObj.getBoolean("error");
//                    if (!error) {
//                        get.setVisibility(View.GONE);
//                        join.setVisibility(View.GONE);
//                        hideDialog();
//                    }else{
//                        String errorMsg = jObj.getString("error_msg");
//                        Toast.makeText(getApplicationContext(),
//                                errorMsg, Toast.LENGTH_LONG).show();
//                        hideDialog();
//                    }
//                }catch (JSONException e) {
//                    // JSON error
//                    e.printStackTrace();
//                    Toast.makeText(getApplicationContext(), "Json error: " + e.getMessage(), Toast.LENGTH_LONG).show();
//                }
//            }
//        }, new Response.ErrorListener() {
//
//            @Override
//            public void onErrorResponse(VolleyError error) {
//                Log.e(" ", "error_msg" + error.getMessage());
//                Toast.makeText(getApplicationContext(),
//                        error.getMessage(), Toast.LENGTH_LONG).show();
//                hideDialog();
//            }
//        }) {
//            @Override
//            protected Map<String, String> getParams() throws AuthFailureError {
//                Map<String, String> params = new HashMap<String, String>();
//                params.put("email", email);
//                return params;
//            }
//        };
//        // Adding request to request queue
//        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
//    }
//    private void fetchDawg(final String email){
//        String tag_string_req = "req_check";
//
//        pDialog.setMessage("Fetching your dawg. . .");
//        showDialog();
//        StringRequest strReq = new StringRequest(Request.Method.POST,
//                AppConfig.ROOT_ABOOK, new Response.Listener<String>() {
//
//            @Override
//            public void onResponse(String response) {
//                Log.d("","Response: " + response.toString());
//                hideDialog();
//                try {
//                    JSONObject jObj = new JSONObject(response);
//                    boolean error = jObj.getBoolean("error");
//                    if (!error) {
//                        get.setVisibility(View.GONE);
//                        join.setVisibility(View.GONE);
//                        hideDialog();
//                    }else{
//                        String errorMsg = jObj.getString("error_msg");
//                        Toast.makeText(getApplicationContext(),
//                                errorMsg, Toast.LENGTH_LONG).show();
//                        hideDialog();
//                    }
//                }catch (JSONException e) {
//                    // JSON error
//                    e.printStackTrace();
//                    Toast.makeText(getApplicationContext(), "Json error: " + e.getMessage(), Toast.LENGTH_LONG).show();
//                }
//            }
//        }, new Response.ErrorListener() {
//
//            @Override
//            public void onErrorResponse(VolleyError error) {
//                Log.e(" ", "error_msg" + error.getMessage());
//                Toast.makeText(getApplicationContext(),
//                        error.getMessage(), Toast.LENGTH_LONG).show();
//                hideDialog();
//            }
//        }) {
//            @Override
//            protected Map<String, String> getParams() throws AuthFailureError {
//                Map<String, String> params = new HashMap<String, String>();
//                params.put("email", email);
//                return params;
//            }
//        };
//        // Adding request to request queue
//        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
//    }
//    private void showDialog() {
//        if (!pDialog.isShowing())
//            pDialog.show();
//    }
//
//    private void hideDialog() {
//        if (pDialog.isShowing())
//            pDialog.dismiss();
//    }
//
//}
