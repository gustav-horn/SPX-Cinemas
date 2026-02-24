
async function submitLocation(location: string) {
        let form = new FormData();
        form.append("location", location)
        let response = await fetch("index.php?page=listings", 
            {
                method: "POST",
                mode: "same-origin",
                credentials: "same-origin",
                body: form
            }
        );
        // console.log(response)
        if (response.redirected === false) {
            var html = await response.text();
            // console.log(html);
            document.open("index.php?page=listings", 'replace');
            document.write(html);
            document.close();
        }
        else {
            window.location.href = response.url;
        }
    }


function onStart(document: Document) {
    document.querySelectorAll(".location-option").forEach(
        (item, _) => item.addEventListener("click", function a(_) { submitLocation(this.getAttribute("value"))})
    )

    document.getElementById("location")!.innerHTML = `&nbsp; ${Array.from(document.getElementsByClassName("active")).filter((item) => item.classList.contains("location-option"))
    .map((item) => item.getAttribute("value") != "All" ? item.getAttribute("value") : "Choose Your Location")} &nbsp; &nbsp;`

}

onStart(window.document)