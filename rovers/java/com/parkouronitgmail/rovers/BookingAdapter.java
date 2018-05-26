package com.parkouronitgmail.rovers;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.RatingBar;
import android.widget.RelativeLayout;
import android.widget.TextView;

import java.util.HashMap;
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
    public void onBindViewHolder(final ProductViewHolder holder, final int position) {
        final bList list = bokList.get(position);


        holder.driver.setText("Driver : "+String.valueOf(list.getD_name()));
        holder.stat.setText("Status : "+String.valueOf(list.getStatus()));
        holder.src.setText("Source : "+String.valueOf(list.getSource()));
        holder.dst.setText("Destination : "+String.valueOf(list.getDestination()));

        holder.rid.setText("ride id : "+list.getR_id());
        holder.pLayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Log.d("","onClick Recycle");
                Intent intent = new Intent(mCtx, RateActivity.class);
                intent.putExtra("driver", list.getD_name());
                intent.putExtra("ride_id", list.getR_id() );
                mCtx.startActivity(intent);

            }
        });

    }

    @Override
    public int getItemCount() {
        return bokList.size();
    }

    class ProductViewHolder extends RecyclerView.ViewHolder {

        TextView driver, stat, src, dst,rid;
        RelativeLayout pLayout;


        public ProductViewHolder(View itemView) {
            super(itemView);
            rid=(TextView)itemView.findViewById(R.id.rideId);
            driver= (TextView) itemView.findViewById(R.id.driverName);
            src=(TextView) itemView.findViewById(R.id.src);
            dst=(TextView) itemView.findViewById(R.id.dst);
            stat=(TextView) itemView.findViewById(R.id.status);
            pLayout=(RelativeLayout) itemView.findViewById(R.id.parentLayout);

        }
    }
}
