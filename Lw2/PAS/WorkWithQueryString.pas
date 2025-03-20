PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES
  GPC;

FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  PosKey, PosMark: INTEGER;
  QueryString: STRING;
BEGIN
  QueryString := GetEnv('QUERY_STRING');
  PosKey := Pos(Key, QueryString);
  QueryString := Copy(QueryString, PosKey, Length(QueryString));
  PosMark := Pos('&', QueryString);

  IF (Copy(GetEnv('QUERY_STRING'), PosKey-1, 1) = '') OR (Copy(GetEnv('QUERY_STRING'), PosKey-1, 1) = '&')
  THEN
    BEGIN
      IF PosMark <> 0
      THEN
        QueryString := Copy(QueryString, Length(Key) + 1, PosMark - Length(Key) - 1)
      ELSE
        QueryString := Copy(QueryString, Length(Key) + 1, Length(QueryString) - Length(Key));
       
      GetQueryStringParameter := QueryString
    END
  ELSE
    GetQueryStringParameter := ''
END;

BEGIN {WorkWithQueryString}
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('First Name: ', GetQueryStringParameter('first_name='));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name='));
  WRITELN('Age: ', GetQueryStringParameter('age='))
END. {WorkWithQueryString}

