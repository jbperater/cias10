
import { Component } from '@angular/core';
//import { NavController } from 'ionic-angular';
import { NavController, AlertController } from 'ionic-angular';
import { AboutPage } from '../about/about';


@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
 username:string;
 password:string;
 myrec:string[];
 pass:string[];
 found:boolean;

 constructor(public navCtrl: NavController, public AlertCtrl: AlertController) {
 this.myrec=["tyfel","chan","joshua"];
 this.pass=["tyfel1","chan1","joshua1"];
 this.found=false;
  }

  login(){
    console.log("Username: "+ this.username);
    console.log("Password: "+ this.password);
    for (let x = 0; x < this.myrec.length; x++){
      console.log("My Array:" +this.myrec[x] );
        if (this.username == this.myrec[x] && this.password==this.pass[x])
      
  {
       let alert = this.AlertCtrl.create(
       {
        title: 'Login Successful!',
        subTitle: "Welcome to this Ionic App" ,
        buttons: ['OK']
        }
        );

   this.navCtrl.push(AboutPage);  
   alert.present(); 
   break;
  }
  else{

      let alert = this.AlertCtrl.create({
        title: 'Login Failed!',
        subTitle: "You don't have an account!",
        buttons: ['OK']
      });
      alert.present();
      break;

  }
 
  }

}
}