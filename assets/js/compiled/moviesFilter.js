"use strict";
/// Submits the location data as a form and overwrites the displayed webpage with the response. 
/// Is probably due for a rewrite
// async function submitLocation(location: string) {
//     let form = new FormData();
//     form.append("location", location)
//     let response = await fetch("index.php?page=listings", 
//         {
//             method: "POST",
//             mode: "same-origin",
//             credentials: "same-origin",
//             body: form
//         }
//     );
//     // console.log(response)
//     if (response.redirected === false) {
//         var html = await response.text();
//         // console.log(html);
//         document.open("index.php?page=listings", 'replace');
//         document.write(html);
//         document.close();
//     }
//     else {
//         window.location.href = response.url;
//     }    
// }
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
function submitLocation(location) {
    return __awaiter(this, void 0, void 0, function* () {
        var form = document.getElementsByTagName("body")[0].appendChild(document.createElement("form"));
        form.action = "";
        form.method = "POST";
        let addData = (name, value) => {
            let input = form.appendChild(document.createElement("input"));
            input.name = name;
            input.value = value;
            return input;
        };
        form.appendChild(addData("location", location));
        form.submit();
    });
}
function onStart(document) {
    // Plumb behaviour for each location option
    document.querySelectorAll(".location-option").forEach((item, _) => item.addEventListener("click", function a(_) { submitLocation(this.getAttribute("value")); }));
    // Set the behaviour for the location form to display when the button is moused over and vanish when the mouse leaves.
    document.getElementById("location-form").addEventListener("mouseleave", () => document.getElementById('location-options').hidden = true);
    document.getElementById("location").addEventListener("mouseover", () => document.getElementById('location-options').hidden = false);
    // We set the active value. The location button's innerHTML is set to the only location-option with the active tag
    document.getElementById("location").innerHTML = `&nbsp; ${Array.from(document.getElementsByClassName("active"))
        .filter((item) => item.classList.contains("location-option"))
        .map((item) => item.getAttribute("value") != "All" ? item.getAttribute("value") : "Choose Your Location")} &nbsp; &nbsp;`;
}
document.addEventListener("DOMContentLoaded", () => onStart(window.document));
