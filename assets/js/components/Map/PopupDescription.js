function PopupDescription({
    popupDescription,
    setPopupDescription
}) {
    return (
        <ul className="d-none d-lg-block border-default m-5">
            <li className="border-default">
                <button
                    className="mb-3 p-2 badge text-white "
                    style={{
                        backgroundColor: '#487f89',
                        border: 'none'
                    }}
                    onClick={() => setPopupDescription( null )}
                >
                    Retour a la navigation
                </button>
                <h3 className="text-dark-primary">{popupDescription.societe}</h3>
                <br/>
                {popupDescription.comment1 ? (
                    <p className="text-dark-primary">
                        {popupDescription.comment1.slice( 0, 150 )
                            .concat( '...' )}
                    </p>
                ) : null}
                {popupDescription.website ? (
                    <a
                        href={popupDescription.website}
                        target="_blank"
                        style={{ wordWrap: 'break-word' }}
                        className="text-dark-primary mt-2 d-block"
                    >
                        {popupDescription.website}
                    </a>
                ) : null}
                <a
                    className="btn text-hover-white text-dark-primary btn-sm mt-3 border-dark-primary"
                    target="_blank"
                    href={`https://www.google.com/maps/search/?api=1&query=${popupDescription.latitude},${popupDescription.longitude}`}
                >
                    Itineraire
                </a>
            </li>
        </ul>
    );
}

export default PopupDescription;
