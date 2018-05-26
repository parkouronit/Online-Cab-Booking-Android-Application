package com.parkouronitgmail.rovers;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.support.design.widget.TextInputEditText;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.RatingBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.parkouronitgmail.rovers.app.AppConfig;
import com.parkouronitgmail.rovers.app.AppController;
import com.parkouronitgmail.rovers.helper.SQLiteHandler;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class RateActivity extends AppCompatActivity {
    private ProgressDialog pDialog;
    private TextView dnam;
    private RatingBar rate;
    private Button bRate;
    private String dNamee,r_id;
    private SQLiteHandler dbs;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_rate);
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);
        dbs = new SQLiteHandler(getApplicationContext());
        dnam=(TextView)findViewById(R.id.dName);
        rate=(RatingBar) findViewById(R.id.dRate);
        bRate=(Button) findViewById(R.id.btRate);
        if(getIntent().hasExtra("driver") && getIntent().hasExtra("ride_id")){
            dNamee = getIntent().getStringExtra("driver");
            r_id = getIntent().getStringExtra("ride_id");
            Log.d("","Driver "+dNamee);
            Log.d("","Ride ID"+r_id);
            dnam.setText(dNamee);

        }
        bRate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                float driver_rate=rate.getRating();

                String rr=Float.toString(driver_rate);
                HashMap<String, String> user = dbs.getUserDetails();
                String email = user.get("email");
                Log.d("rate"+rr,"ride id"+r_id);
                Log.d("user"+email,"driver"+dNamee);
                rateDriver(r_id,email,dNamee,rr);

            }
        });










    }

    private void rateDriver(final String r_id,final String u_email,final String d_email,final String rate){
        String tag_string_req = "req_rate";
        StringRequest strReq = new StringRequest(Request.Method.POST,
                AppConfig.ROOT_FEED, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");
                    if (!error) {
                        pDialog.show();
                        String errorMsg = jObj.getString("error_msg");
                        Toast.makeText(getApplicationContext(),
                                errorMsg, Toast.LENGTH_LONG).show();
                        Intent i=new Intent(RateActivity.this,MainActivity.class);
                        startActivity(i);
                    }else {
                        String errorMsg = jObj.getString("error_msg");
                        Toast.makeText(getApplicationContext(),
                                errorMsg, Toast.LENGTH_LONG).show();
                        pDialog.hide();
                    }
                    pDialog.hide();
                }catch (JSONException e) {
                    e.printStackTrace();
                    Toast.makeText(getApplicationContext(), "Json error: " + e.getMessage(), Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e(" ", "error_msg" + error.getMessage());
                Toast.makeText(getApplicationContext(),
                        error.getMessage(), Toast.LENGTH_LONG).show();
                hideDialog();
            }
        }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<String, String>();
                params.put("ride_id", r_id);
                params.put("user_email",u_email);
                params.put("driver_email", d_email);
                params.put("rate",rate);
                return params;
            }
        };
        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
    }
    private void showDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hideDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }
}
