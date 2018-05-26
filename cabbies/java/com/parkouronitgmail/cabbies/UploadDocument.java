package com.parkouronitgmail.cabbies;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;

public class UploadDocument extends AppCompatActivity implements View.OnClickListener {
    private ImageButton license,rc,insurance,permit;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_upload_document);
        license=(ImageButton)findViewById(R.id.license);
        rc=(ImageButton)findViewById(R.id.rc);
        insurance=(ImageButton)findViewById(R.id.insurance);
        permit=(ImageButton)findViewById(R.id.permit);
        license.setOnClickListener(this);
        rc.setOnClickListener(this);
        insurance.setOnClickListener(this);
        permit.setOnClickListener(this);
    }


    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.license:
                Intent i=new Intent(getApplicationContext(),LicenceUpload.class);
                startActivity(i);
                finish();
                break;
            case R.id.rc:
                Intent j=new Intent(getApplicationContext(),rc.class);
                startActivity(j);
                finish();
                break;
            case R.id.insurance:
                Intent k=new Intent(getApplicationContext(),insurance.class);
                startActivity(k);
                finish();
                break;
            case R.id.permit:
                Intent l=new Intent(getApplicationContext(),permit.class);
                startActivity(l);
                finish();
                break;
        }
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Intent l=new Intent(getApplicationContext(),MainActivity.class);
        startActivity(l);
        finish();
    }
}
