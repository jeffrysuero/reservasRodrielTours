const locales = ["es-ES", "en-GB"];

function getFlagSrc(countryCode) {
    return /^[A-Z]{2}$/.test(countryCode)
        ? `https://flagsapi.com/${countryCode.toUpperCase()}/shiny/64.png`
        : "";
}

const dropdownBtn = document.getElementById("dropdown-btn");
const dropdownContent = document.getElementById("dropdown-content");

function setSelectedLocale(locale, isUserAction = false) {
    console.log("🚀 ~ setSelectedLocale ~ locale:", locale);

    const intlLocale = new Intl.Locale(locale);
    console.log("🚀 ~ setSelectedLocale ~ intlLocale:", intlLocale.baseName);

    const langName = new Intl.DisplayNames([locale], {
        type: "language",
    }).of(intlLocale.language);

    dropdownContent.innerHTML = "";

    const otherLocales = locales.filter((loc) => loc !== locale);
    otherLocales.forEach((otherLocale) => {
        const otherIntlLocale = new Intl.Locale(otherLocale);
        const otherLangName = new Intl.DisplayNames([otherLocale], {
            type: "language",
        }).of(otherIntlLocale.language);

        const listEl = document.createElement("li");
        listEl.innerHTML = `${otherLangName}<img src="${getFlagSrc(
            otherIntlLocale.region
        )}" />`;
        listEl.value = otherLocale;
        listEl.addEventListener("mousedown", function () {
            setSelectedLocale(otherLocale, true);
        });
        dropdownContent.appendChild(listEl);
    });

    dropdownBtn.innerHTML = `<img src="${getFlagSrc(
        intlLocale.region
    )}" />${langName}<span class="arrow-down"></span>`;

    // Guardar el idioma seleccionado en localStorage
    localStorage.setItem('selectedLocale', locale);

    // Manejar la redirección según el idioma seleccionado si es una acción del usuario
    if (isUserAction) {
        if (locale === 'en-GB') {
            location.href = '/reservasRodrielTours/en/index.php';
        } else {
            location.href = '/reservasRodrielTours/index.php';
        }
    }
}

// Obtener el idioma seleccionado de localStorage
const storedLocale = localStorage.getItem('selectedLocale');

// Establecer el idioma desde localStorage si existe, de lo contrario, usar el idioma predeterminado
if (storedLocale) {
    setSelectedLocale(storedLocale);
} else {
    setSelectedLocale(locales[0]);
}

// Obtener el idioma del navegador y seleccionar el idioma correspondiente si está disponible
const browserLang = new Intl.Locale(navigator.language).language;
for (const locale of locales) {
    const localeLang = new Intl.Locale(locale).language;

    if (localeLang === browserLang && !storedLocale) {
        setSelectedLocale(locale);
    }
}
