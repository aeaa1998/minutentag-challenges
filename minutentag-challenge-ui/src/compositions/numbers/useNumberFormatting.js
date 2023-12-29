//The composition to format a value into an specific currency including its language
export const usePriceCurrencyFormat = (price, lang = "en-US", currency = "USD") => Intl.NumberFormat(lang, {
    style: "currency",
    currency: currency,
}).format(price / 100)