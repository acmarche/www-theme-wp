function ResultItemKml( propos ) {
    const { item } = propos;
    function createMarkup() {
        return { __html: item?.description };
    }
    return (
        <>
            <li className="col-12 col-md-6 col-xl-4 py-16px">
                <a href={item.url} className="object-target">
                    <h4 className="ff-semibold lh-150">{item.nom}</h4>
                    <p className="d-flex pt-8px lh-150" dangerouslySetInnerHTML={createMarkup()}/>
                </a>
            </li>
        </>
    );
}

export default ResultItemKml;
