PROGRAM WelcomeUser(INPUT, OUTPUT);
USES
  GPC;
VAR
  QueryString, User: STRING;
  PosUser: INTEGER;

FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  PosKey, PosMark: INTEGER;
  QueryString: STRING;
BEGIN
  QueryString := GetEnv('QUERY_STRING');
  PosKey := Pos(Key, QueryString);
  QueryString := Copy(QueryString, PosKey, Length(QueryString) - PosKey + 1);
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

BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  User := GetQueryStringParameter('name=');

  WRITE('Hello dear, ');
  IF User <> ''
  THEN
    WRITELN(User, '!')
  ElSE
    WRITELN('Anonumus!')
END.
