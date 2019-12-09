(function($) {
    class Person{

    constructor(firstname, lastname, email, address, phone, password){
        this.firstname = firstname;
        this.lastname = lastname;
        this.email = email;
        this.address = address;
        this.phone = phone;
        this.password = password;
    }

    display(){
        console.log(this.firstname + " " + this.lastname + " " + this.email + " " + this.address + " " + this.phone + " " + this.password);
        let display = document.getElementById("display");
        display.innerHTML = "<h2>" + "Name: " + this.firstname + " " + this.lastname + " " + "<br>Email: " + this.email + "<br>Address" + this.address + "<br>Phone" + this.phone + "</h2>";
    }
}

class PersonBuilder{
    setFirstName(firstname){
        this.firstname = firstname;

        return this;
    }

    setEmail(email){
        this.email = email;

        return this;
    }

    setAddress(address){
        this.address = address;

        return this;
    }

    setPhoneNumber(phone){
        this.phone = phone;

        return this;
    }

    setPassword(password){
        this.password = password;

        return this;
    }

    build(){
        return new Person(this.firstname, this.lastname, this.email, this.address, this.phone, this.phone, this.password);
    }
}

$(document).ready(function(){
    $("#form").on("submit", function(e){
        e.preventDefault();
        display();
        return false;
    });
});

function display(){
    let first = document.getElementById("first");
    let last = document.getElementById("last");
    let email = document.getElementById("email");

    let person = new PersonBuilder().setName(first.value, last.value).setEmail(email.value).build();

    person.display();
}
});

