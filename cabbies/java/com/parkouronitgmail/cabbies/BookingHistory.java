package com.parkouronitgmail.cabbies;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.parkouronitgmail.cabbies.helper.SQLiteHandler;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class BookingHistory extends AppCompatActivity {
    private static final String URL_PRODUCTS = "https://seely-sled.000webhostapp.com/bookList.php";

    //a list to store all the products
    List<bList> bookList;
    private SQLiteHandler dbs;
    //the recyclerview
    RecyclerView recyclerView;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_booking_history);
        //getting the recyclerview from xml
        dbs = new SQLiteHandler(getApplicationContext());
        recyclerView = (RecyclerView) findViewById(R.id.BookList);
        recyclerView.setHasFixedSize(true);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));

        //initializing the productlist
        bookList = new ArrayList<>();
        HashMap<String, String> user = dbs.getUserDetails();
        String email = user.get("email");
        //this method will fetch and parse json
        //to display it in recyclerview
        loadProducts(email);
    }

    private void loadProducts(final String email) {
        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_PRODUCTS,
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

                                //adding the product to product list
                                bookList.add(new bList(
                                        books.getString("user_email"),
                                        books.getString("stats"),
                                        books.getString("Source"),
                                        books.getString("Destination")

                                ));
                            }

                            //creating adapter object and setting it to recyclerview
                            BookingAdapter adapter = new BookingAdapter(BookingHistory.this, bookList);
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
