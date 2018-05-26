package com.parkouronitgmail.cabbies;

/**
 * Created by parkouRonit on 19-02-2018.
 */

public class dawg {
    String names;
    double longitude,latitude;

    public dawg(String name,double lon,double lat) {
        this.names=name;
        this.latitude=lat;
        this.longitude=lon;
    }


    public void setNames(String names) {
        this.names = names;
    }

    public void setLatitude(double latitude) {
        this.latitude = latitude;
    }

    public void setLongitude(double longitude) {
        this.longitude = longitude;
    }

    public String getNames() {
        return names;
    }

    public double getLongitude() {
        return longitude;
    }

    public double getLatitude() {
        return latitude;
    }
}
