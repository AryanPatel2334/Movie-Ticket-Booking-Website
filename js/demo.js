console.log("Let's write javascript...");
let currFolder;

// Add an eventlistener to filters
// Languages

const languagesElement = document.querySelector(".languages");
const multiboxElement = languagesElement.querySelector(".multibox");

let isExpanded = false;

languagesElement.addEventListener("click", () => {
    isExpanded = !isExpanded;

    if (isExpanded) {
        languagesElement.style.height = "45px";
        multiboxElement.style.visibility = "hidden";
    } else {
        languagesElement.style.height = "195px";
        multiboxElement.style.visibility = "visible";
    }
});


const genresElement = document.querySelector(".genres");
const multiboxElement1 = genresElement.querySelector(".multibox");

let isExpanded1 = false;

genresElement.addEventListener("click", () => {
    isExpanded1 = !isExpanded1;

    if (isExpanded1) {
        genresElement.style.height = "45px";
        multiboxElement1.style.visibility = "hidden";
    } else {
        genresElement.style.height = "300px";
        multiboxElement1.style.visibility = "visible";
    }
});


const formatElement = document.querySelector(".format");
const multiboxElement2 = formatElement.querySelector(".multibox");

let isExpanded2 = false;

formatElement.addEventListener("click", () => {
    isExpanded2 = !isExpanded2;

    if (isExpanded2) {
        formatElement.style.height = "45px";
        multiboxElement2.style.visibility = "hidden";
    } else {
        formatElement.style.height = "150px";
        multiboxElement2.style.visibility = "visible";
    }
});


async function getPosters(folder,data) {
    currFolder = folder;
    let a = await fetch(`http://127.0.0.1:3000/${folder}/${data}`);
    let response = await a.text();
    let div = document.createElement("div");
    div.innerHTML = response;
    let as = div.getElementsByTagName("a")
    console.log(as);
}

getPosters("Movies/Hindi","Puspa");


async function getMovies(folder) {

    let Movies = document.querySelector(".movies");
    Movies.innerHTML = '';
    // currFolder = folder
    let a = await fetch(`http://127.0.0.1:3000/Movies/${folder}`);
    // let cover = await fetch(`http://127.0.0.1:3000/Movies/${folder}/${data}`);
    // console.log(cover);
    let response = await a.text();
    let div = document.createElement("div");
    div.innerHTML = response
    let anchors = div.getElementsByTagName("a")
    let array = Array.from(anchors)
    for (let index = 0; index < array.length; index++) {
        const e = array[index];

        if (e.href.includes("/Movies")) {
            let folder = e.href.split("/").slice(-2)[0];
            // console.log(folder);

            // Get the metadata of the folder
            let ak = await fetch(`http://127.0.0.1:3000/Movies/${folder}/info.json`);
            // let mname = await fetch(`http://127.0.0.1:3000/Movies/${folder}/${mname}`);
            let response = await ak.json();
            // console.log(response);
            Movies.innerHTML = Movies.innerHTML + `<div class="movie" data-folder="${folder}" data-language="${response.Language}">
                        <img src="Movies/${folder}/cover.avif" alt="">
                        <p class="title">${response.title}</p>
                        <p class="mtype">${response.type}</p>
                        <p class="language">${response.Language}</p>
                    </div>`
        }
    }
    // console.log(anchors);

    // Load the Movies when button is clicked


    Array.from(document.getElementsByClassName("Hindi")).forEach(e => {
        e.addEventListener("click", async item => {
            item.stopPropagation();
            // console.log(item.currentTarget.dataset.folder);
            await getMovies(`Movies/${item.currentTarget.dataset.folder}`);
        })
    })

    
    Array.from(document.getElementsByClassName("All")).forEach(e => {
        e.addEventListener("click", async item => {
            item.stopPropagation();
            // console.log(item.currentTarget.dataset.folder);
            await getMovies(`Movies/${item.currentTarget.dataset.folder}`);
        })
    })

     
    Array.from(document.getElementsByClassName("English")).forEach(e => {
        e.addEventListener("click", async item => {
            item.stopPropagation();
            // console.log(item.currentTarget.dataset.folder);
            await getMovies(`Movies/${item.currentTarget.dataset.folder}`);
        })
    })

    // document.getElementsByClassName("Hindi").addEventListener("click",async (e)=>{
    //     e.stopPropagation();
    //     await getMovies(`Movies/${item.currentTarget.dataset.folder}`)
    // })

}

document.querySelector(".Hindi").addEventListener("click", () => {
    document.querySelector(".Hindi").style.backgroundColor = "red";
    document.querySelector(".Hindi").style.color = "white";
    document.querySelector(".Hindi").style.border = "2px solid red";
    document.querySelector(".Hindi").style.fontWeight = 600;
})



document.querySelector(".All").addEventListener("click", () => {
    document.querySelector(".All").style.backgroundColor = "red";
    document.querySelector(".All").style.color = "white";
    document.querySelector(".All").style.border = "2px solid red";
    document.querySelector(".All").style.fontWeight = 600;
})



document.querySelector(".English").addEventListener("click", () => {
    document.querySelector(".English").style.backgroundColor = "red";
    document.querySelector(".English").style.color = "white";
    document.querySelector(".English").style.border = "2px solid red";
    document.querySelector(".English").style.fontWeight = 600;
})

function toggleMoviesByLanguage(language) {
    const allMovies = document.querySelectorAll(".movie");
    
    allMovies.forEach(movie => {
        if (language == "All" || movie.dataset.language == language) {
            movie.style.display = "block";  // Show movie
        } else {
            // movie.style.display = "none";  // Hide movie
            // console.log("display");
        }
    });
}

document.querySelectorAll(".language-btn").forEach(button => {
    button.addEventListener("click", async (e) => {
        const language = e.target.dataset.language;
        const button = e.target;
        
        // Toggle active class for buttons
        document.querySelectorAll(".language-btn").forEach(b => b.classList.remove("active"));
        button.classList.add("active");
        
        // Fetch movies for the selected language or all if "All" button is clicked
        if (language == "All") {
            await getMovies("All");
        } else{
            await getMovies(language);
        }
        
        // Toggle the visibility based on the selected language
        toggleMoviesByLanguage(language);
    });
});

// Initialize with all movies visible
getMovies("All").then(() => toggleMoviesByLanguage("All"));








