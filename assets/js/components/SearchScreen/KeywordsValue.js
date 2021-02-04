const {
    useState,
    useEffect
} = wp.element;

function KeywordsValue({
    inputContent,
    keywordsElement
}) {
    const [ filteredKeywords, setFilteredKeywords ] = useState([]);

    //   Cette fonction est lancee a chaque fois que l'inputContent est modifie
    //   si le contenu est present dans un des mots cles, le mot cle est stocke et rendu ci dessous
    useEffect( () => {
        if ( inputContent ) {
            //   console.log("before filter", keywordsElement);
            const filteredKeywords = keywordsElement.filter( ( elem ) => elem.name.toLowerCase()
                .includes( inputContent.toLowerCase() ) );

            //   console.log("FilteredKeywords", filteredKeywords);
            filteredKeywords ?
                setFilteredKeywords( filteredKeywords ) :
                setFilteredKeywords([]);
        }
    }, [ inputContent ]);

    return (
        <>
            {0 !== filteredKeywords.length ? (

                //Le slice permet de limiter le nombre de proposition
                filteredKeywords.slice( 0, 10 )
                    .map( ( elem, index ) => (
                        <li
                            key={index}
                            className="col-ls-6 col-ls-sm-4 col-xl-12 col-ls-xl-12"
                        >
                            <a href={`/?s=${elem.name}`} className="icon_custom">
                                <i className="i-search i-dark-primary w-16px h-16px"></i>
                                {elem.name}
                            </a>
                        </li>
                    ) )
            ) : (
                <li className="col-ls-6 col-ls-sm-4 col-xl-12 col-ls-xl-12">
                    <a className="icon_custom">
                        <i className="i-search i-dark-primary w-16px h-16px"></i>
                        Pas de proposition
                    </a>
                </li>
            )}
        </>
    );
}

export default KeywordsValue;
