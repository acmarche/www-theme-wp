function HardCodedValues() {
    return (
        <>
            {/* <!--visible from landscape&&large / large--> */}
            <ul className="d-none d-ls-lg-flex d-lg-flex flex-wrap justify-content-center mw-500px pt-42px mx-auto
                   ">
                <li className="col-3 d-flex justify-content-center">
                    <a href="/sport/piscine-communale" className="icon_custom">
                        <i className=" d-block w-54px h-54px shadow-sm-2 mx-auto rounded-circle i-swimmer i-bg-white i-bg-hover-primary i-hover-white i-bg-color-transition bg-size-62"></i>
                        <span className="d-inline-block text-white fs-short-3 ff-semibold lh-150 pt-6px">Piscine</span>
                    </a>
                </li>
                <li className="col-3 d-flex justify-content-center">
                    <a href="/environnement" className="icon_custom">
                        <i className=" d-block w-54px h-54px shadow-sm-2 mx-auto rounded-circle i-leaf i-bg-white i-bg-hover-primary i-hover-white i-bg-color-transition bg-size-53"></i>
                        <span className="d-inline-block text-white fs-short-3 ff-semibold lh-150 pt-6px">Environnement Déchet</span>
                    </a>
                </li>
                <li className="col-3 d-flex justify-content-center">
                    <a href="/mobilite/infos-travaux/" className="icon_custom">
                        <i className=" d-block w-54px h-54px shadow-sm-2 mx-auto rounded-circle i-traffic-cone i-bg-white i-bg-hover-primary i-hover-white i-bg-color-transition bg-size-48"></i>
                        <span className="d-inline-block text-white fs-short-3 ff-semibold lh-150 pt-6px">Travaux<br />Arrêtés de police</span>
                    </a>
                </li>
                <li className="col-3 d-flex justify-content-center">
                    <a href="https://enfance-jeunesse.marche.be" className="icon_custom">
                        <i className=" d-block w-54px h-54px shadow-sm-2 mx-auto rounded-circle i-beach-ball i-bg-white i-bg-hover-primary i-hover-white i-bg-color-transition bg-size-55"></i>
                        <span className="d-inline-block text-white fs-short-3 ff-semibold lh-150 pt-6px">Enfance Jeunesse</span>
                    </a>
                </li>
                <li className="col-3 pt-12px d-flex justify-content-center">
                    <a href="/tourisme/cartographie" className="icon_custom">
                        <i className=" d-block w-54px h-54px shadow-sm-2 mx-auto rounded-circle i-map i-bg-white i-bg-hover-primary i-hover-white i-bg-color-transition bg-size-55"></i>
                        <span className="d-inline-block text-white fs-short-3 ff-semibold lh-150 pt-6px">Cartes dynamiques</span>
                    </a>
                </li>
                <li className="col-3 pt-12px d-flex justify-content-center">
                    <a href="/social/centre-public-daction-sociale-cpas/" className="icon_custom">
                        <i className=" d-block w-54px h-54px shadow-sm-2 mx-auto rounded-circle i-handshake i-bg-white i-bg-hover-primary i-hover-white i-bg-color-transition bg-size-55"></i>
                        <span className="d-inline-block text-white fs-short-3 ff-semibold lh-150 pt-6px">CPAS</span>
                    </a>
                </li>
                <li className="col-3 pt-12px d-flex justify-content-center">
                    <a href="https://citoyen.marche.be" className="icon_custom">
                        <i className=" d-block w-54px h-54px shadow-sm-2 mx-auto rounded-circle i-envelope i-bg-white i-bg-hover-primary i-hover-white i-bg-color-transition bg-size-55"></i>
                        <span className="d-inline-block text-white fs-short-3 ff-semibold lh-150 pt-6px">Mon adresse e-mail</span>
                    </a>
                </li>
            </ul>

        </>
    );
}

export default HardCodedValues;
