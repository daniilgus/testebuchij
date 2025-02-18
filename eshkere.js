
    // Функция для загрузки изображений с PostImage
    async function loadImages() {
        try {
            // URL альбома на PostImage (замените на свой альбом)
            const albumUrl = 'https://postimg.cc/gallery/fNKnFtT'; // Замени на реальный ID альбома

            // Получаем HTML-код страницы альбома
            const response = await fetch(albumUrl);
            const html = await response.text();

            // Создаем временный элемент для парсинга HTML
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            // Находим все изображения на странице
            const images = Array.from(doc.querySelectorAll('.image-item img'))
                .map(img => img.src);

            // Добавляем изображения в контейнер
            const artContainer = document.getElementById('artContainer');
            images.forEach(imageSrc => {
                const imgElement = document.createElement('img');
                imgElement.src = imageSrc;
                imgElement.classList.add('img-fluid', 'art-item');
                imgElement.style.margin = '10px';
                imgElement.style.width = '100%';
                artContainer.appendChild(imgElement);
            });
        } catch (error) {
            console.error('Ошибка при загрузке изображений:', error);
        }
    }

    // Вызываем функцию при загрузке страницы
    window.onload = loadImages;
