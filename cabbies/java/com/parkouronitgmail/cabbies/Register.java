package com.parkouronitgmail.cabbies;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.parkouronitgmail.cabbies.app.AppConfig;
import com.parkouronitgmail.cabbies.app.AppController;
import com.parkouronitgmail.cabbies.helper.SQLiteHandler;
import com.parkouronitgmail.cabbies.helper.SessionManager;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.InputStream;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class Register extends AppCompatActivity {
    private EditText inputFullName;
    private EditText inputEmail;
    private EditText inputContact;
    private Button btnRegister;
    private EditText inputPassword;
    private ProgressDialog pDialog;
    private Spinner spinner;
    private TextView carsss;
    private ArrayList<carList> carlist;
    private SessionManager session;
    private SQLiteHandler db;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        inputFullName = (EditText) findViewById(R.id.etUsername);
        inputEmail = (EditText) findViewById(R.id.etEmail);
        spinner=(Spinner)findViewById(R.id.sCarSelect);
        carlist = new ArrayList<carList>();
        carsss=(TextView)findViewById(R.id.tvSelcar);
        inputPassword = (EditText) findViewById(R.id.etPassword);
        inputContact = (EditText) findViewById(R.id.etContact);
        btnRegister = (Button) findViewById(R.id.btRegister);
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);
        // Session manager
        session = new SessionManager(getApplicationContext());
        getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_STATE_VISIBLE| WindowManager.LayoutParams.SOFT_INPUT_ADJUST_RESIZE);
        // SQLite database handler
        db = new SQLiteHandler(getApplicationContext());

        // Check if user is already logged in or not
        if (session.isLoggedIn()) {
            // User is already logged in. Take him to main activity
            Intent intent = new Intent(Register.this,
                    MainActivity.class);
            startActivity(intent);
            finish();
        }
        spinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                String c=parent.getItemAtPosition(position).toString();

                carsss.setText(c);
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });
        // Register Button Click event
        btnRegister.setOnClickListener(new View.OnClickListener() {
            public void onClick(View view) {
                String name = inputFullName.getText().toString().trim();
                String email = inputEmail.getText().toString().trim();
                String password = inputPassword.getText().toString().trim();
                String contact = inputContact.getText().toString().trim();
                String getcars = carsss.getText().toString().trim();
                if (!name.isEmpty() && !email.isEmpty()&& !contact.isEmpty() && !password.isEmpty()&& !getcars.isEmpty()) {
                    registerUser(name, email, password, contact,getcars);
                } else {
                    Toast.makeText(getApplicationContext(),
                            "Please enter your details!", Toast.LENGTH_LONG)
                            .show();
                }
            }
        });
        new GetCategories().execute();
    }
    private void populateSpinner() {
        List<String> lables = new ArrayList<String>();

        for (int i = 0; i < carlist.size(); i++) {
            lables.add(carlist.get(i).getName());
        }

        // Creating adapter for spinner
        ArrayAdapter<String> spinnerAdapter = new ArrayAdapter<String>(this,
                android.R.layout.simple_spinner_item, lables);

        // Drop down layout style - list view with radio button
        spinnerAdapter
                .setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        // attaching data adapter to spinner
        spinner.setAdapter(spinnerAdapter);
    }
    private class GetCategories extends AsyncTask<Void, Void, Void> {
        UrlConnection conn;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected Void doInBackground(Void... params) {
            Log.d("doinbackground"," ");
            String result;

            conn=new UrlConnection();
            InputStream os=conn.ByGetMethod("https://seely-sled.000webhostapp.com/selectCab.php");
            result =conn.ConvertStramatoString(os);
            if(result!=null){
                try{
                    JSONArray categories = new JSONArray(result);

                    for (int i = 0; i < categories.length(); i++) {
                        JSONObject catObj = (JSONObject) categories.get(i);
                        carList cat = new carList(catObj.getString("car_name"));
                        carlist.add(cat);
                    }

                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            populateSpinner();
            super.onPostExecute(aVoid);
        }
    }
    private void registerUser(final String name,final String email,final String password,final String contact,final String carsss) {
        // Tag used to cancel the request
        String tag_string_req = "req_register";

        pDialog.setMessage("Registering ...");
        showDialog();

        StringRequest strReq = new StringRequest(Request.Method.POST,
                AppConfig.url_register, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                Log.d(" ", "Register Response: " + response.toString());
                hideDialog();

                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");
                    if (!error) {
                        // User successfully stored in MySQL
                        // Now store the user in sqlite
                        String uid = jObj.getString("uid");

                        JSONObject user = jObj.getJSONObject("user");
                        String name = user.getString("name");
                        String email = user.getString("email");
                        String contact = user.getString("contact");
                        String cartype = user.getString("car_name");

                        // Inserting row in users table
                        db.addUser(name, email, uid, contact,cartype);

                        Toast.makeText(getApplicationContext(), "User successfully registered. Try login now!", Toast.LENGTH_LONG).show();

                        // Launch login activity
                        Intent intent = new Intent(
                                Register.this,
                                Login.class);
                        startActivity(intent);
                        finish();
                    } else {

                        // Error occurred in registration. Get the error
                        // message
                        String errorMsg = jObj.getString("error_msg");
                        Toast.makeText(getApplicationContext(),
                                errorMsg, Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
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
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting params to register url
                Map<String, String> params = new HashMap<String, String>();
                params.put("name", name);
                params.put("email", email);
                params.put("password", password);
                params.put("contact", contact);
                params.put("car_name", carsss);
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
