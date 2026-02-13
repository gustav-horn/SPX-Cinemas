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
        console.log(response)
        if (response.redirected === false) {
            var html = await response.text();
            console.log(html);
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
}

onStart(window.document)