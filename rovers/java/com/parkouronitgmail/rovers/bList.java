package com.parkouronitgmail.rovers;

/**
 * Created by parkouRonit on 5/18/2018.
 */

public class bList {
    private String r_id;
    private String d_name;
    private String status;
    private String source;
    private String destination;

    public bList(String d_name,String status,String source,String destination,String r_id) {
        this.d_name=d_name;
        this.status=status;
        this.source=source;
        this.destination=destination;

        this.r_id=r_id;
    }

    public String getD_name() {
        return d_name;
    }
    public String getDestination() {
        return destination;
    }

    public String getStatus() {
        return status;
    }

    public String getSource() {
        return source;
    }
    public String getR_id() {
        return r_id;
    }
}
