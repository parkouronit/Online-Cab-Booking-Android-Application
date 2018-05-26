package com.parkouronitgmail.rovers;

import android.accounts.NetworkErrorException;
import android.graphics.Color;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.widget.ListView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.parkouronitgmail.rovers.helper.SQLiteHandler;
import com.parkouronitgmail.rovers.helper.SessionManager;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class BookingDetails extends AppCompatActivity {
    private static final String URL_BOOK = "https://seely-sled.000webhostapp.com/ubookList.php";
    List<bList> bbList;
    RecyclerView recyclerView;
    private SQLiteHandler dbs;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_booking_details);
        dbs = new SQLiteHandler(getApplicationContext());
        // session manager
        recyclerView = (RecyclerView) findViewById(R.id.BookList);
        recyclerView.setHasFixedSize(true);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        bbList = new ArrayList<>();

        HashMap<String, String> user = dbs.getUserDetails();
        String email = user.get("email");
        
            loadBooking(email);
       

    }

    private void loadBooking(final String email) {
        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_BOOK,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            //converting the string to json array object
                            JSONArray array = new JSONArray(response);

                            //traversing through all the object
                            for (int i = 0; i < array.length(); i++) {

                                //getting product object from json array
                                JSONObject books = array.getJSONObject(i);
                                books.getString("stats");

                                bbList.add(new bList(

                                        books.getString("driver_email"),
                                        books.getString("stats"),
                                        books.getString("Source"),
                                        books.getString("Destination"),
                                        books.getString("ride_id")
                                ));
                            }

                            //creating adapter object and setting it to recyclerview
                            BookingAdapter adapter = new BookingAdapter(BookingDetails.this, bbList);
                            recyclerView.setAdapter(adapter);
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                    }
                }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<String, String>();
                params.put("email", email);
                return params;
            }
        };

        //adding our stringrequest to queue
        Volley.newRequestQueue(this).add(stringRequest);
    }
}
