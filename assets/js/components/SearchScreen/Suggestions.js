function Suggestions({
    suggestionsList
}) {
    return (
        <>
            {0 !== suggestionsList.length ? (
                suggestionsList.map( ( elem, index ) => (
                    <li
                        key={index}
                        className="col-ls-6 col-ls-sm-4 col-xl-12 col-ls-xl-12"
                    >
                        <a href={`/?s=${elem}`} className="icon_custom">
                            {elem}
                        </a>
                    </li>
                ) )
            ) : (
                <li className="col-ls-6 col-ls-sm-4 col-xl-12 col-ls-xl-12">
                    <a className="icon_custom">
                        Pas de proposition
                    </a>
                </li>
            )}
        </>
    );
}

export default Suggestions;
