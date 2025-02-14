function Suggestions({
    suggestionsList
}) {
    return (
        <>
            <ul>
                {0 !== suggestionsList.length ? (
                    suggestionsList.map( ( elem, index ) => (
                        <li key={index} className="col-ls-6">
                            <a href={`/?s=${elem}`} className="icon_custom">
                                {elem}
                            </a>
                        </li>
                    ) )
                ) : (
                    <>
                        <i className="graphicElement"></i>
                    </>
                )}
            </ul>
        </>
    );
}

export default Suggestions;
