package com.parkouronitgmail.rovers;

import android.graphics.Bitmap;
import android.util.Log;

import com.google.android.gms.maps.model.LatLng;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

/**
 * Created by rkm on 04-12-2017.
 */

public class UrlConnection {



        InputStream ByGetMethod(String strurl){
            InputStream is=null;
            try{
                URL url=new URL(strurl);
                HttpURLConnection con=(HttpURLConnection)url.openConnection();
                con.setReadTimeout(5000);
                con.setConnectTimeout(5000);
                con.setRequestMethod("GET");
                con.setDoInput(true);
                int response=con.getResponseCode();
                if(response==HttpURLConnection.HTTP_OK){
                    is=con.getInputStream();
                }
            }catch(Exception e){
                Log.e("LOG_TAG","Error in getDATA",e);
            }
            return is;
        }

        InputStream ByPostMethod(String strurl,double lon,double lat,String email){
            InputStream is=null;
            try{
                String quaryparams="longitude="+lon+"&latitude="+lat+"&email="+email;
                URL url =new URL(strurl);
                HttpURLConnection con=(HttpURLConnection)url.openConnection();
                con.setReadTimeout(5000);
                con.setConnectTimeout(5000);
                con.setRequestMethod("POST");
                con.setDoInput(true);
                con.connect();
                DataOutputStream os=new DataOutputStream(con.getOutputStream());
                os.writeBytes(quaryparams);
                os.flush();
                os.close();
                int response=con.getResponseCode();
                if(response==HttpURLConnection.HTTP_OK){
                    is=con.getInputStream();
                }
            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
            return  is;
        }
    InputStream CancelBooking(String strurl,String rideid,String did){
        InputStream is=null;
        try{
            String quaryparams="ride_id="+rideid+"&driver_id="+did;
            URL url =new URL(strurl);
            HttpURLConnection con=(HttpURLConnection)url.openConnection();
            con.setReadTimeout(5000);
            con.setConnectTimeout(5000);
            con.setRequestMethod("POST");
            con.setDoInput(true);
            con.connect();
            DataOutputStream os=new DataOutputStream(con.getOutputStream());
            os.writeBytes(quaryparams);
            os.flush();
            os.close();
            int response=con.getResponseCode();
            if(response==HttpURLConnection.HTTP_OK){
                is=con.getInputStream();
            }
        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
        return  is;
    }
    InputStream ChangePAsswordPostMethod(String strurl,String email,String oldpass,String newpass){
        InputStream is=null;
        try{
            String quaryparams="email="+email+"&encrypted_password="+oldpass+"&newpassword="+newpass;
            URL url =new URL(strurl);
            HttpURLConnection con=(HttpURLConnection)url.openConnection();
            con.setReadTimeout(5000);
            con.setConnectTimeout(5000);
            con.setRequestMethod("POST");
            con.setDoInput(true);
            con.connect();
            DataOutputStream os=new DataOutputStream(con.getOutputStream());
            os.writeBytes(quaryparams);
            os.flush();
            os.close();
            int response=con.getResponseCode();
            if(response==HttpURLConnection.HTTP_OK){
                is=con.getInputStream();
            }
        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
        return  is;
    }

        String ConvertStramatoString(InputStream stream) {
            InputStreamReader isr=new InputStreamReader(stream);
            BufferedReader reader=new BufferedReader(isr);
            StringBuilder response=new StringBuilder();
            String line;
            try{
                while((line=reader.readLine())!=null){
                    response.append(line);
                }
            } catch (IOException e) {
                Log.e("LOG_TAG","Error in convert stream to a string",e);
            }catch(Exception e){
                Log.e("LOG_TAG","Error in convert stream to a string",e);

            }finally {
                try{
                    stream.close();

                }catch (IOException e){
                    Log.e("LOG_TAG","Error in Converting String to string",e);
                }catch(Exception e){
                    Log.e("LOG_TAG","Error in Converting String to string",e);
                }
            }
            return response.toString();
        }
    }

