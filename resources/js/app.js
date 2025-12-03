import './bootstrap';
import $ from "jquery";

// none jQuery version is
// document.getElementById("chirpsContainer").addEventLinster(you know what else);
// $("#chirpsContainer").on('click', async function (e) {
//     const btn = e.target.closest(".toggleBtn");
//     if (!btn) return;
//
//     const chirpId = btn.dataset.id
//     // const btnText = document.getElementById(`text-${chirpId}`);
//     const btnText = $(`#text-${chirpId}`);
//     const liked = btn.dataset.liked === "1";
//     const counter = $(`#likes-${chirpId}`)
//     console.log(btn.dataset.liked, liked)
//     const url = liked ? `/chirps/${chirpId}/unlike` : `/chirps/${chirpId}/like`
//
//     // https://stackoverflow.com/questions/36956693/including-csrf-token-in-the-layout
//     // const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//
//     // console.log({token})
//
//     // tried the classic async await fetch. still works. idk if optimal
//     // try {
//     //     const res = await fetch(url, {
//     //         method: liked ? "DELETE" : "POST",
//     //         headers: {
//     //             "x-csrf-token": token,
//     //             "Content-Type": "application/json"
//     //         }
//     //     })
//     //
//     //     const data = await res.json();
//     //     // console.log({btn});
//     //
//     //     counter.textContent = data.likes_count
//     //
//     //     if (liked) {
//     //         btn.dataset.liked = "0";
//     //         btnText.textContent = "Like";
//     //         btn.classList.add("btn-outline");
//     //     } else {
//     //         btn.dataset.liked = "1";
//     //         btnText.textContent = "Unlike";
//     //         btn.classList.remove("btn-outline");
//     //     }
//     // } catch (err) {
//     //     console.error("Error: ", err)
//     // }
//
//     // tried the jQuery ajax version
//     $.ajax({
//         url: url,
//         type: liked ? "DELETE" : "POST",
//         headers: {
//             // https://stackoverflow.com/questions/36956693/including-csrf-token-in-the-layout
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
//         },
//         dataType: "json",
//         success: function (res) {
//             console.log("Success: ", res)
//             // counter.textContent = res.likes_count
//             counter.text(res.likes_count);
//             if (liked) {
//                 btn.dataset.liked = "0";
//                 // btnText.textContent = "Like";
//                 btnText.text("Like")
//                 // btn.classList.add("btn-outline");
//             } else {
//                 btn.dataset.liked = "1";
//                 // btnText.textContent = "Unlike";
//                 btnText.text("Unlike")
//                 // btn.classList.remove("btn-outline");
//             }
//         },
//         error: function (xhr, status, error) {
//             // Callback function executed on error
//             console.error("Something error:", xhr.status, status, error);
//             if (xhr.status) {
//                 window.location.href = "http://final-assignment-w0531640.test/login";
//             }
//         },
//     })
// })

// none jQuery version is
// document.getElementById("chirpsContainer").addEventLinster(you know what else);
async function thingy(btn) {
    // console.log({isAuth})
    // if (!isAuth) {
    //     return false;
    // }

    const chirpId = btn.dataset.id
    // const btnText = document.getElementById(`text-${chirpId}`);
    const btnText = document.getElementById(`text-${chirpId}`);
    const liked = btn.dataset.liked === "1";
    const counter = document.getElementById(`likes-${chirpId}`)
    console.log(btn.dataset.liked, liked)
    const url = liked ? `/chirps/${chirpId}/unlike` : `/chirps/${chirpId}/like`

    // https://stackoverflow.com/questions/36956693/including-csrf-token-in-the-layout
    // const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

    // console.log({token})

    // tried the classic async await fetch. still works. idk if optimal
    try {
        const res = await fetch(url, {
            method: liked ? "DELETE" : "POST",
            headers: {
                // "x-csrf-token": token,
                "Content-Type": "application/json"
            }
        })
        if (res.redirected === true) {
            // console.log({res})
            window.location.href = res.url;
        }
        const data = await res.json();
        // console.log({btn});

        counter.textContent = data.likes_count

        if (liked) {
            btn.dataset.liked = "0";
            btnText.textContent = "Like";
            btn.classList.add("btn-outline");
        } else {
            btn.dataset.liked = "1";
            btnText.textContent = "Unlike";
            btn.classList.remove("btn-outline");
        }
    } catch (err) {
        console.error("Error: ", err)
    }


}

window.thingy = thingy;

async function bookmark(btn) {

    const chirpId = btn.dataset.id

    const isBookmarked = btn.dataset.bookmarked === "1"

    console.log({btn})

    console.log({isBookmarked})

    try {
        const res = await fetch(`chirps/${chirpId}/bookmark`, {
                "method": isBookmarked ? "DELETE" : "POST"
            }
        )

        const data = await res.json()

        console.log({data})

        if (isBookmarked) {
            btn.dataset.bookmarked = ""
            btn.textContent = "Bookmark"
        } else {
            btn.textContent = "Unbookmark"
            btn.dataset.bookmarked = "1"
        }

    } catch (err) {
        console.error("Error: ", err)
    }
}

window.bookmark = bookmark;
