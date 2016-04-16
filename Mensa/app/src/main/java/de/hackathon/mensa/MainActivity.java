package de.hackathon.mensa;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        TextView txtTitle = (TextView) findViewById(R.id.txtTitle);
        assert txtTitle != null;
        txtTitle.setText("Hallo ");
        txtTitle.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Toast.makeText(getApplicationContext(), "Hallo Welt", Toast.LENGTH_LONG).show();
            }
        });
    }
}
