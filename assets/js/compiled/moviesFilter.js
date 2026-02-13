"use strict";
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
        let form = new FormData();
        form.append("location", location);
        let response = yield fetch("index.php?page=listings", {
            method: "POST",
            mode: "same-origin",
            credentials: "same-origin",
            body: form
        });
        console.log(response);
        if (response.redirected === false) {
            var html = yield response.text();
            console.log(html);
            document.open("index.php?page=listings", 'replace');
            document.write(html);
            document.close();
        }
        else {
            window.location.href = response.url;
        }
    });
}
function onStart(document) {
    document.querySelectorAll(".location-option").forEach((item, _) => item.addEventListener("click", function a(_) { submitLocation(this.getAttribute("value")); }));
}
onStart(window.document);
