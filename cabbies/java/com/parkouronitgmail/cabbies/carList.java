package com.parkouronitgmail.cabbies;

/**
 * Created by parkouRonit on 13-01-2018.
 */

public class carList {
    private String carname;
    public carList(String carname){
        this.carname =carname;
    }
    public void setName(String name){
        this.carname = carname;
    }
    public String getName(){
        return this.carname;
    }
}
