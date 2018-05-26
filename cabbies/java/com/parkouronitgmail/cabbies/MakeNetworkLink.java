package com.parkouronitgmail.cabbies;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.TextView;

import com.google.android.gms.maps.model.LatLng;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.InputStream;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.jar.JarFile;

/**
 * Created by rkm on 04-12-2017.
 */

public class MakeNetworkLink extends AsyncTask<String,Integer,String> {

    String method,email,dawg;
    UrlConnection conn;
    double lon,lat;

    public MakeNetworkLink(String email, double latitude, double longitude, String post) {
        this.email=email;
        this.lat=latitude;
        this.lon=longitude;
        this.method=post;
    }

    public MakeNetworkLink(String email, String gettag) {
        this.email=email;
        this.method=gettag;
    }

    public MakeNetworkLink(String email, String dawg, String jointag) {
        this.email=email;
        this.dawg=dawg;
        this.method=jointag;
    }


    @Override
    protected String doInBackground(String... params) {
        Log.d("in BackGround"," ");
        String result=null;

        if(this.method=="POST"){
            conn=new UrlConnection();
            InputStream os=conn.ByPostMethod("http://seely-sled.000webhostapp.com/driverGPS.php",this.lon,this.lat,this.email);
            result =conn.ConvertStramatoString(os);
        }
        if(this.method=="GETTAG"){
            conn=new UrlConnection();
            InputStream os=conn.getTag("http://seely-sled.000webhostapp.com/createDawg.php",this.email);
            result =conn.ConvertStramatoString(os);
        }
        if(this.method=="JOINTAG"){
            conn=new UrlConnection();
            InputStream os=conn.JoinTag("http://seely-sled.000webhostapp.com/joinDawg.php",this.email,this.dawg);
            result =conn.ConvertStramatoString(os);
        }

        return result;
    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();
        Log.d("in preExecute"," ");


    }

    @Override
    protected void onPostExecute(String s) {
        super.onPostExecute(s);
        Log.d("in prostExecute",s);



    }
}
