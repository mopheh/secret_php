const logout = () => {
  $.ajax({
    url: "logout.php",
    type: "POST",
    success: function (data) {
      console.log(data)
      if (data) {
        window.location.href = "login.php"
      }
    },
    error: function () {
      alert("There was some error performing the AJAX call!")
    },
  })
}

$(document).ready(function () {
  $("#login").submit(function (e) {
    e.preventDefault()
    $.ajax({
      url: "../data.php",
      type: "POST",
      data: $(this).serialize(),
      success: function (data) {
        console.log(data)
        let response = JSON.parse(data)
        if (response.success) {
          location.href = "secret.php"
        }
      },
      error: function () {
        alert("There was some error performing the AJAX call!")
      },
    })
    $("#login .form-control").map((index, element) => {
      if (element.value == "") {
        const e = new Event("change")
        element.dispatchEvent(e)
      }
    })
  })
})

$("#login .form-control").on("input focusout change keyup", function (e) {
  //   console.log(e.target.id)
  login(e.target.id)
})

const login = (input) => {
  if ($(`#${input}`).val() == "") {
    $(`#${input}`).addClass("is-invalid")
    $(`.${input}`).text(`${input} is required`)
  } else {
    if (input == "email") {
      validateEmail("login", input)
    }
    if (input == "password") {
      turnValid(input)
    }
  }
}

$("#register .form-control").on("input focusout change keyup", function (e) {
  validate(e.target.id)
})

const validate = (input) => {
  if ($(`#${input}`).val() == "") {
    $(`#${input}`).addClass("is-invalid")
    $(`.${input}`).text(`${input} is required`)
  } else {
    if (input == "name") {
      turnValid(input)
    }
    if (input == "email") {
      validateEmail("register", input)
    }
    if (input == "password") {
      turnValid(input)
    }
    if (input == "confirmPassword") {
      if ($(`#password`).val() != $(`#confirmPassword`).val()) {
        turnInvalid(input, "Passwords do not match", false)
      } else {
        turnValid(input)
      }
    }
  }
}

const turnValid = (tag) => {
  $(`#${tag}`).removeClass("is-invalid")
  $(`#${tag}`).addClass("is-valid")
}
const turnInvalid = (input, message, combine) => {
  $(`#${input}`).removeClass("is-valid")
  $(`#${input}`).addClass("is-invalid")
  if (combine) {
    $(`.${input}`).text(`${input} ${message}`)
  } else {
    $(`.${input}`).text(`${message}`)
  }
}

$(document).ready(function () {
  $("#register").submit(function (e) {
    e.preventDefault()

    $.ajax({
      url: "var.php",
      type: "POST",
      data: $(this).serialize(),
      success: function (response) {
        console.log(response)
        let data = JSON.parse(response)
        if (data.success) {
          location.href = "secret.php"
        }
      },
    })
    $(".form-control").map((index, element) => {
      if (element.value == "") {
        const e = new Event("change")
        element.dispatchEvent(e)
      }
    })
  })
})

function validateEmail(page, input) {
  email = $(`#${input}`).val()
  var xmlhttp = new XMLHttpRequest()
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText.trim() == "User already exist") {
        page == "register"
          ? turnInvalid(input, this.responseText.trim(), false)
          : turnValid(input)
      } else if (this.responseText.trim() == "User does not exist") {
        page == "register"
          ? turnValid(input)
          : turnInvalid(input, this.responseText.trim(), false)
      }
    }
  }
  xmlhttp.open("GET", "getuser.php?q=" + email.trim(), true)
  xmlhttp.send()
}
