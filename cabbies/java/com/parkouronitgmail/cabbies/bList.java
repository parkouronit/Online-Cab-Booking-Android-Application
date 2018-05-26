package com.parkouronitgmail.cabbies;

/**
 * Created by parkouRonit on 5/21/2018.
 */

public class bList {
    private String u_name;
    private String source;
    private String destination;
    private String status;
    public bList(String u_name,String source,String destination,String status) {
        this.u_name=u_name;
        this.source=source;
        this.destination=destination;
        this.status=status;
    }

    public String getD_name() {
        return u_name;
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
}
