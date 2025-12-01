<x-layout>
    <x-slot:title>
        Home Feed
    </x-slot:title>
    <div class="max-w-2xl mx-auto">

        <h1 class="text-3xl font-bold mt-8">Latest Chirps</h1>

        {{--        Chirp Form --}}
        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <form method="POST" action="/chirps">
                    @csrf
                    <div class="form-control w-full">
                        <textarea
                            name="message"
                            placeholder="What's on your mind?"
                            class="textarea textarea-bordered w-full resize-none @error('message') textarea-error @enderror"
                            rows="4"
                            maxlength="255"
{{--                            required--}}
                        >{{ old('message') }}</textarea>

                        @error('message')
                        <div class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Chirp
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Feed -->
        <div id="chirpsContainer" class="space-y-4 mt-8">
            @forelse ($chirps as $chirp)
                <x-chirp :chirp="$chirp"/>
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <svg class="mx-auto h-12 w-12 opacity-30" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="mt-4 text-base-content/60">No chirps yet. Be the first to chirp!</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        async function thingy(btn, isAuth) {
            console.log({isAuth})
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
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

            console.log({token})

            // tried the classic async await fetch. still works. idk if optimal
            try {
                const res = await fetch(url, {
                    method: liked ? "DELETE" : "POST",
                    headers: {
                        "x-csrf-token": token,
                        "Content-Type": "application/json"
                    }
                })
                if(res.redirected === true) {
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

            // tried the jQuery ajax version
            // $.ajax({
            //     url: url,
            //     type: liked ? "DELETE" : "POST",
            //     headers: {
            //         // https://stackoverflow.com/questions/36956693/including-csrf-token-in-the-layout
            //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            //     },
            //     dataType: "json",
            //     success: function (res) {
            //         console.log("Success: ", res)
            //         // counter.textContent = res.likes_count
            //         counter.text(res.likes_count);
            //         if (liked) {
            //             btn.dataset.liked = "0";
            //             // btnText.textContent = "Like";
            //             btnText.text("Like")
            //             // btn.classList.add("btn-outline");
            //         } else {
            //             btn.dataset.liked = "1";
            //             // btnText.textContent = "Unlike";
            //             btnText.text("Unlike")
            //             // btn.classList.remove("btn-outline");
            //         }
            //     },
            //     error: function (xhr, status, error) {
            //         // Callback function executed on error
            //         console.error("Something error:", xhr.status, status, error);
            //         if (xhr.status) {
            //             window.location.href = "http://final-assignment-w0531640.test/login";
            //         }
            //     },
            // })
        }
    </script>
</x-layout>
