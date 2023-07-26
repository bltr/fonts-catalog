function share(e)
{
    const network = e.target.dataset.social
    const page_url =location.href
    const title = document.title
    const image = document.querySelector('link[rel="apple-touch-icon"]').getAttribute('href')

    const urls = {
        vk() {
            let url = new URL('https://vk.com/share.php')
            url.searchParams.set('url', page_url)
            url.searchParams.set('title', title)
            url.searchParams.set('image', image)

            return url
        },
        telegram() {
            let url = new URL('https://t.me/share/url')
            url.searchParams.set('url', page_url)

            return url
        },
        twitter() {
            let url = new URL('https://twitter.com/share')
            url.searchParams.set('url', page_url)
            url.searchParams.set('text', title)

            return url
        },
        whatsapp() {
            let url = new URL('https://api.whatsapp.com/send')
            url.searchParams.set('text', page_url)

            return url
        }
    };


    const options = 'width=640,height=480,left=640,top=284';
    window.open(urls[network](), 'Share me', options)
}

const init = () => document.querySelectorAll('[data-social]').forEach((el) => el.addEventListener('click', share))

document.addEventListener('DOMContentLoaded', init)
