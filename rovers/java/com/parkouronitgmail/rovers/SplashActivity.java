package com.parkouronitgmail.rovers;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.animation.AnimationUtils;
import android.widget.ImageView;

public class SplashActivity extends AppCompatActivity {
    private ImageView iv;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);
        this.iv=(ImageView)findViewById(R.id.splash);
        this.iv.startAnimation(AnimationUtils.loadAnimation(this,R.anim.trans));
        final Intent i=new Intent(SplashActivity.this,Login.class);
        new Thread(){
            public void run(){
                try{
                    Thread.sleep(3000);
                }catch (InterruptedException e){
                    e.printStackTrace();
                }finally {
                    SplashActivity.this.startActivity(i);
                    SplashActivity.this.finish();
                }
            }
        }.start();
    }
}
