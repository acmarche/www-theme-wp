import FiltreLi from './FiltreLi';
import FiltreSelect from './FiltreSelect';

function FiltreNew() {
    return (
        <>
            {/* <!--tabs --> */}
            <div
                className="col-12 col-lg-3 px-0 lg-shadow-sm-1 position-relative z-10 overflowY-auto mh-700px">
                <FiltreLi></FiltreLi>
                <FiltreSelect></FiltreSelect>
            </div>
        </>
    );
}

export default FiltreNew;
