package com.parkouronitgmail.cabbies;

/**
 * Created by parkouRonit on 5/21/2018.
 */

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.List;

/**
 * Created by parkouRonit on 5/19/2018.
 */

public class BookingAdapter extends RecyclerView.Adapter<BookingAdapter.ProductViewHolder> {

    private Context mCtx;
    private List<bList> bokList;

    public BookingAdapter(Context mCtx, List<bList> productList) {
        this.mCtx = mCtx;
        this.bokList = productList;
    }

    @Override
    public ProductViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater inflater = LayoutInflater.from(mCtx);
        View view = inflater.inflate(R.layout.custom_booking_list, null);
        return new ProductViewHolder(view);
    }

    @Override
    public void onBindViewHolder(ProductViewHolder holder, int position) {
        bList list = bokList.get(position);


        holder.driver.setText("Driver : "+list.getD_name());
        holder.src.setText("Source : "+list.getSource());
        holder.dst.setText("Destination : "+String.valueOf(list.getDestination()));
        holder.stat.setText("Status : "+String.valueOf(list.getStatus()));

    }

    @Override
    public int getItemCount() {
        return bokList.size();
    }

    class ProductViewHolder extends RecyclerView.ViewHolder {

        TextView driver, stat, src, dst;



        public ProductViewHolder(View itemView) {
            super(itemView);

            driver= (TextView) itemView.findViewById(R.id.userName);
            src=(TextView) itemView.findViewById(R.id.src);
            dst=(TextView) itemView.findViewById(R.id.dst);
            stat=(TextView) itemView.findViewById(R.id.status);


        }
    }
}