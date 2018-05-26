package com.parkouronitgmail.rovers;

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
    ImageView imageView;
    String method,email,oldpass,newpass,rideid,did;
    UrlConnection conn;
    Spinner spin;
    ArrayList<carList> carlist;
    double lon,lat;


    public MakeNetworkLink(double longitude, double latitude, String email, String post) {
        this.lon=longitude;
        this.lat=latitude;
        this.method=post;
        this.email=email;
    }
    public MakeNetworkLink(String ride_id, String d_id, String cancelride) {
        this.did=d_id;
        this.rideid=ride_id;
        this.method=cancelride;
    }


    @Override
    protected String doInBackground(String... params) {
        Log.d("in BackGround"," ");
        String result=null;

        if(this.method=="POST"){
            conn=new UrlConnection();
            InputStream os=conn.ByPostMethod("http://seely-sled.000webhostapp.com/updateGPS.php",this.lon,this.lat,this.email);
            result =conn.ConvertStramatoString(os);
        }
        if(this.method=="CHANGEPOST"){
            conn=new UrlConnection();
            InputStream os=conn.ChangePAsswordPostMethod("http://192.168.137.1/project/changepass.php",this.email,this.oldpass,this.newpass);
            result =conn.ConvertStramatoString(os);
        }if(this.method=="CANCELRIDE"){
            conn=new UrlConnection();
            InputStream os=conn.CancelBooking("http://192.168.137.1/project/cancelBooking.php",this.rideid,this.did);
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
