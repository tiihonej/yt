/* Validointifunktiot */

$(document).ready(function(){

$.validator.addMethod("time", function(value, element) {  
  return this.optional(element) || /^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])?$/i.test(value);  
}, "Kirjoita aika oikeassa muodossa.");

  /* tekijöiden lisäys- ja muokkausfunktio */
  $('form#tekijatiedot').validate({
    rules :{
      'etunimi': {
        'required': true,
        'maxlength': 20
      },
      'sukunimi': {
        'required': true,
        'maxlength': 20
      },
      'lempinimi': {
        'maxlength': 20
      },
      'email': {
        'required': true,
        'maxlength': 40,
        'email': true
      },
      'puhelin': {
        'digits': true,
        'required': true,
        'rangelength': [9, 12]
      },
      'allergiat': {
        'maxlength': 100
      },
      'ehdot': {
        'required': true
      }
    },
    errorElement: "span",
    errorPlacement: function(error, element) {
      error.appendTo( element.parent("td").next("td") );
    }
  });
  /* Kyydin luomislomake */
  $('form#luokyyti').validate({
    rules :{
      'aika': {
        'time': true,
        'required': true
      },
      'paikka': {
        'required': true,
        'maxlength': 50
      },
      'lisatiedot': {
        'maxlength': 200
      }
    },
    errorElement: "span",
    errorPlacement: function(error, element) {
      error.appendTo( element.parent("td").next("td") );
    }
  });
});

/* Virheilmoitukset suomeksi */

jQuery.extend(jQuery.validator.messages, {
    required: "Pakollinen kenttä.",
    email: "Tarkista sähköpostiosoite.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Please enter a valid number.",
    digits: "Syötä pelkkiä numeroita.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Please enter the same value again.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Tämän kentän maksimipituus on {0} merkkiä."),
    minlength: jQuery.validator.format("Tämän kentän minimipituus on {0} merkkiä."),
    rangelength: jQuery.validator.format("Kentän oltava pituudeltaan välillä {0} ja {1}."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});

/* Tunnistautuminen */

$(function() {
  $("table#tunnistaudutable td").click(function() {
    $("table#tunnistaudutable td").each(function() {
      $(this).attr("class", "tavis")
      $(this).find("input").prop("checked", false);
      $(this).css("background","rgba(0,0,0,0.2)");
    });

    $(this).attr("class", "tekijavalittu");
    $(this).find("input").prop("checked", true);
    $(this).css("background","rgba(0,255,0,0.2)");

  }).mouseover(function() {
    $(this).css("background","rgba(0,0,255,0.2)");

  }).mouseout(function() {
    $(this).css("background","rgba(0,0,0,0.2)");
    $("td.tekijavalittu").css("background","rgba(0,255,0,0.2)");
  });
  $("form#tunnistauduform").validate({
    rules:{
      'tekija': {
        'required': true
      }
    },
    'messages': {
      'tekija': {
        'required': "Valitse oma nimesi klikkaamalla tai luo uusi profiili yllä olevasta napista."
      }
    },
    errorElement: "span",
    errorPlacement: function(error, element) {
      error.appendTo( "#error" );
    }
  });
});

/* Togglaa osa-alueiden nimilistat */

$(function() {
  $(".alue th.otsikko").click(function() {
    var id = $(this).find("span").text();
    if ( $("#alue"+id+" div").is(":hidden") ) {
      $("#alue"+id+" div").show();
    } else {
      $("#alue"+id+" div").hide();
    }
  });
  $(".alue li").click(function() {
    var spani = $(this).find("span");
    if ( spani.is(":hidden") ) {
      spani.show();
    } else {
      spani.hide();
    }
  });
  $(".kyyti li").click(function() {
    var spani = $(this).find("span");
    if ( spani.is(":hidden") ) {
      spani.show();
    } else {
      spani.hide();
    }
  });
  $(".tapahtuma th.otsikko").click(function() {
    var id = $(this).find("span").text();
    if ( $("#tapahtuma"+id+" div").is(":hidden") ) {
      $("#tapahtuma"+id+" div").show();
    } else {
      $("#tapahtuma"+id+" div").hide();
    }
  });
  $(".kyyti th.otsikko").click(function() {
    var id = $(this).find("span").text();
    if ( $("#kyyti"+id+" div").is(":hidden") ) {
      $("#kyyti"+id+" div").show();
    } else {
      $("#kyyti"+id+" div").hide();
    }
  });
  $(".tuote th.otsikko").click(function() {
    var id = $(this).find("span").text();
    if ( $("#tuote"+id+" div").is(":hidden") ) {
      $("#tuote"+id+" div").show();
    } else {
      $("#tuote"+id+" div").hide();
    }
  });
});

/* Tuominen */

$(function() {
  $("select.valitsetekija").hide();
  $("div#salasanakysely").hide();
  $("select#tuontivalinta").change(function() {
    $("select.valitsetekija").hide();
    var pref = $(this).val();
    $("select#valitse"+pref).show();
  });
  $("select.valitsetekija").change(function() {
    var tek = $(this).val();
    if ( tek = 0) {
      $("div#salasanakysely").hide();
    } else {
      $("div#salasanakysely").show();
    }
  });
});
